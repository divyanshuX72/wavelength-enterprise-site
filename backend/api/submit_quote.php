<?php
/**
 * Quote Request Form Handler
 * With full security stack and database logging
 */

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

require_once __DIR__ . '/../includes/csrf_handler.php';
require_once __DIR__ . '/../includes/mail_handler.php';

// Response helper
function sendResponse($success, $message, $data = []) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method.');
}

// Validate CSRF token
$csrfToken = $_POST['csrf_token'] ?? '';
if (!validateCSRFToken($csrfToken)) {
    sendResponse(false, 'Invalid security token. Please refresh the page and try again.');
}

// Check honeypot field
$honeypot = $_POST['website'] ?? '';
if (!validateHoneypot($honeypot)) {
    error_log('Honeypot triggered for IP: ' . getClientIP());
    sendResponse(false, 'An error occurred. Please try again.');
}

// IP-based rate limiting
$rateLimit = checkIPRateLimit('quote', 60, 3);
if (!$rateLimit['allowed']) {
    sendResponse(false, 'Too many requests. Please wait ' . $rateLimit['waitTime'] . ' seconds before trying again.');
}

// Get and sanitize input
$fullName = sanitizeInput($_POST['fullName'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$mobile = sanitizeInput($_POST['mobile'] ?? '');
$projectType = sanitizeInput($_POST['projectType'] ?? '');
$budget = sanitizeInput($_POST['budget'] ?? '');
$description = sanitizeInput($_POST['description'] ?? '');

// Validation
$errors = [];

$nameError = validateRequired($fullName, 'Full name', 2, 100);
if ($nameError) $errors[] = $nameError;

$emailError = validateEmail($email);
if ($emailError) $errors[] = $emailError;

$mobileError = validateMobile($mobile);
if ($mobileError) $errors[] = $mobileError;

$projectTypeError = validateRequired($projectType, 'Project type', 2, 100);
if ($projectTypeError) $errors[] = $projectTypeError;

$budgetError = validateRequired($budget, 'Budget', 2, 50);
if ($budgetError) $errors[] = $budgetError;

$descriptionError = validateRequired($description, 'Project description', 20, 2000);
if ($descriptionError) $errors[] = $descriptionError;

if (!empty($errors)) {
    sendResponse(false, 'Validation failed.', ['errors' => $errors]);
}

// Log submission to database
$submissionId = logFormSubmission([
    'form_type' => 'quote',
    'full_name' => $fullName,
    'email' => $email,
    'mobile' => $mobile,
    'subject' => 'Quote Request: ' . $projectType,
    'message' => $description,
    'additional_data' => [
        'project_type' => $projectType,
        'budget' => $budget
    ]
]);

if (!$submissionId) {
    error_log('Failed to log quote form submission to database');
}

// Prepare email data
$ipAddress = getClientIP();
$adminEmailData = [
    'Full Name' => $fullName,
    'Email' => $email,
    'Mobile Number' => $mobile,
    'Project Type' => $projectType,
    'Budget Range' => $budget,
    'Project Description' => $description
];

// Send email to admin
$adminEmailBody = generateEmailTemplate(
    'New Quote Request',
    $adminEmailData,
    $ipAddress,
    'This is a new quote request from the website.'
);

$adminEmailResult = sendEmail([
    'to' => ADMIN_EMAIL,
    'subject' => 'Quote Request: ' . $projectType,
    'body' => $adminEmailBody,
    'replyTo' => $email,
    'replyToName' => $fullName
]);

$adminNotified = $adminEmailResult['success'];

if (!$adminNotified) {
    error_log('Failed to send admin email: ' . ($adminEmailResult['error'] ?? 'Unknown error'));
}

// Send confirmation email to customer
$customerEmailBody = generateConfirmationEmail($fullName, 'Quote');

$customerEmailResult = sendEmail([
    'to' => $email,
    'subject' => 'Quote Request Received - Wavelength Enterprises',
    'body' => $customerEmailBody
]);

$customerNotified = $customerEmailResult['success'];

if (!$customerNotified) {
    error_log('Failed to send customer confirmation email: ' . ($customerEmailResult['error'] ?? 'Unknown error'));
}

// Update email status in database
if ($submissionId) {
    updateEmailStatus($submissionId, $adminNotified, $customerNotified);
}

// Regenerate CSRF token
regenerateCSRFToken();

// Success response
if ($adminNotified) {
    sendResponse(true, 'Thank you! Your quote request has been submitted successfully. We will contact you soon with a detailed quotation.', [
        'submission_id' => $submissionId
    ]);
} else {
    sendResponse(false, 'Your request was received but there was an error sending notifications. We will review your submission shortly.');
}
