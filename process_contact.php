<?php
header('Content-Type: application/json');
require_once 'config/db_connection.php';
require_once 'config/email_config.php';
require_once 'includes/email_templates.php';

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 0);
error_reporting(E_ALL);

function sendResponse($success, $message, $debug = null) {
    echo json_encode([
        'success' => $success, 
        'message' => $message,
        'debug' => $debug
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

$action = $_POST['action'] ?? '';

if ($action === 'book_visit') {
    // 1. Sanitize & Validate
    $type = $conn->real_escape_string($_POST['type'] ?? '');
    $date = $conn->real_escape_string($_POST['date'] ?? '');
    $time = $conn->real_escape_string($_POST['time'] ?? '');
    $location_type = $conn->real_escape_string($_POST['location_type'] ?? '');
    $address = $conn->real_escape_string($_POST['address'] ?? '');
    $landmark = $conn->real_escape_string($_POST['landmark'] ?? '');
    $pincode = $conn->real_escape_string($_POST['pincode'] ?? '');
    $google_map = $conn->real_escape_string($_POST['google_map'] ?? '');

    if (empty($type) || empty($date) || empty($time)) {
        sendResponse(false, 'Missing required booking fields');
    }

    // 2. Insert into DB
    $sql = "INSERT INTO bookings (location_type, address, landmark, pincode, google_map, visit_date, visit_time, status) 
            VALUES ('$location_type', '$address', '$landmark', '$pincode', '$google_map', '$date', '$time', 'pending')";

    if ($conn->query($sql)) {
        // 3. Send Emails
        try {
            $mailer = getMailer();
            
            // Admin Notification
            $mailer->addAddress(ADMIN_EMAIL); 
            // Note: Booking form currently doesn't capture email in step 1-2, so no Reply-To $email
            $mailer->Subject = 'New Visit Scheduled: ' . $date . ' at ' . $time;
            $mailer->Body = getAdminVisitNotificationBody($_POST);
            $mailer->send();
            
            // Note: We don't have user email in booking form yet based on current wizard steps
            // If we add it later, we can send confirmation here.
            
            sendResponse(true, 'Visit scheduled successfully');
        } catch (Exception $e) {
            // Log error but still return success for booking
            error_log("Email Error: " . $e->getMessage());
            sendResponse(true, 'Visit scheduled but email failed'); 
        }
    } else {
        sendResponse(false, 'Database error: ' . $conn->error);
    }

} elseif ($action === 'get_quote') {
    // 1. Sanitize & Validate
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    
    // Handle product/furniture_type mapping
    $product_input = $_POST['product'] ?? '';
    $furniture_input = $_POST['furniture_type'] ?? '';
    $product = $conn->real_escape_string(!empty($product_input) ? $product_input : $furniture_input);
    
    $message = $conn->real_escape_string($_POST['message'] ?? '');
    $room_type = $conn->real_escape_string($_POST['room_type'] ?? '');
    
    // Extended fields
    $length = !empty($_POST['length']) ? floatval($_POST['length']) : 'NULL';
    $height = !empty($_POST['height']) ? floatval($_POST['height']) : 'NULL';
    $depth = !empty($_POST['depth']) ? floatval($_POST['depth']) : 'NULL';
    $budget = !empty($_POST['budget']) ? floatval($_POST['budget']) : 'NULL';

    if (empty($name) || empty($email) || empty($phone)) {
        sendResponse(false, 'Missing required contact fields');
    }

    // 2. Insert into DB
    $sql = "INSERT INTO quotes (name, email, phone, furniture_type, room_type, message, length, height, depth, budget, status) 
            VALUES ('$name', '$email', '$phone', '$product', '$room_type', '$message', $length, $height, $depth, $budget, 'pending')";

    if ($conn->query($sql)) {
        // 3. Send Emails
        try {
            $mailer = getMailer();
            
            // Admin Notification
            $mailer->addAddress(ADMIN_EMAIL);
            $mailer->addReplyTo($email, $name);
            $mailer->Subject = 'New Quote Request from ' . $name;
            $mailer->Body = getAdminQuoteNotificationBody($_POST);
            $mailer->send();
            
            // User Confirmation
            $mailer->clearAddresses();
            $mailer->addAddress($email);
            $mailer->Subject = 'We received your quote request - Wavelength Enterprises';
            $mailer->Body = getUserQuoteConfirmationBody($_POST);
            $mailer->send();
            
            sendResponse(true, 'Quote request sent successfully');
        } catch (Exception $e) {
             error_log("Email Error: " . $e->getMessage());
             sendResponse(true, 'Quote saved but email failed');
        }
    } else {
        sendResponse(false, 'Database error: ' . $conn->error);
    }

} else {
    sendResponse(false, 'Invalid action');
}

$conn->close();
?>
