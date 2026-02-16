<?php
/**
 * Enhanced Contact Form Handler
 * With CSRF, Honeypot, IP Rate Limiting, and Database Logging
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
    // Bot detected - log but don't reveal
    error_log('Honeypot triggered for IP: ' . getClientIP());
    sendResponse(false, 'An error occurred. Please try again.');
}

// IP-based rate limiting
$rateLimit = checkIPRateLimit('contact', 60, 3);
if (!$rateLimit['allowed']) {
    sendResponse(false, 'Too many requests. Please wait ' . $rateLimit['waitTime'] . ' seconds before trying again.');
}

// Get and sanitize input
$fullName = sanitizeInput($_POST['fullName'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$mobile = sanitizeInput($_POST['mobile'] ?? '');
$subject = sanitizeInput($_POST['subject'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

// Validation
$errors = [];

$nameError = validateRequired($fullName, 'Full name', 2, 100);
if ($nameError) $errors[] = $nameError;

$emailError = validateEmail($email);
if ($emailError) $errors[] = $emailError;

$mobileError = validateMobile($mobile);
if ($mobileError) $errors[] = $mobileError;

$subjectError = validateRequired($subject, 'Subject', 3, 200);
if ($subjectError) $errors[] = $subjectError;

$messageError = validateRequired($message, 'Message', 10, 2000);
if ($messageError) $errors[] = $messageError;

if (!empty($errors)) {
    sendResponse(false, 'Validation failed.', ['errors' => $errors]);
}

// Log submission to database
$submissionId = logFormSubmission([
    'form_type' => 'contact',
    'full_name' => $fullName,
    'email' => $email,
    'mobile' => $mobile,
    'subject' => $subject,
    'message' => $message
]);

if (!$submissionId) {
    error_log('Failed to log contact form submission to database');
}

// Prepare email data
$ipAddress = getClientIP();
$adminEmailData = [
    'Full Name' => $fullName,
    'Email' => $email,
    'Mobile Number' => $mobile,
    'Subject' => $subject,
    'Message' => $message
];

// Send email to admin
$adminEmailBody = generateEmailTemplate(
    'New Contact Form Submission',
    $adminEmailData,
    $ipAddress,
    'This is a new contact request from the website.'
);

$adminEmailResult = sendEmail([
    'to' => ADMIN_EMAIL,
    'subject' => 'Contact Form: ' . $subject,
    'body' => $adminEmailBody,
    'replyTo' => $email,
    'replyToName' => $fullName
]);

$adminNotified = $adminEmailResult['success'];

if (!$adminNotified) {
    error_log('Failed to send admin email: ' . ($adminEmailResult['error'] ?? 'Unknown error'));
}

// Send confirmation email to customer
$customerEmailBody = generateConfirmationEmail($fullName, 'Contact');

$customerEmailResult = sendEmail([
    'to' => $email,
    'subject' => 'Thank You for Contacting Us - Wavelength Enterprises',
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

// Regenerate CSRF token for security
regenerateCSRFToken();

// Success response
if ($adminNotified) {
    sendResponse(true, 'Thank you! Your message has been sent successfully. We will get back to you soon.', [
        'submission_id' => $submissionId
    ]);
} else {
    sendResponse(false, 'Your message was received but there was an error sending notifications. We will review your submission shortly.');
}
