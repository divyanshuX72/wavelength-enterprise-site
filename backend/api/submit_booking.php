<?php
header('Content-Type: application/json');
require_once '../config/db_connection.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Extract and sanitize data
$location_type = $conn->real_escape_string($input['type'] ?? '');
$address = $conn->real_escape_string($input['data']['address'] ?? '');
$landmark = $conn->real_escape_string($input['data']['landmark'] ?? '');
$pincode = $conn->real_escape_string($input['data']['pincode'] ?? '');
$google_map = $conn->real_escape_string($input['data']['google_map'] ?? ''); // Not in JS logic yet but in HTML? Check HTML.
// Wait, checking booking.js, it doesn't seem to capture google_map. 
// Let's re-check booking.js validateStep(2). It only captures address, landmark, pincode.
// But HTML has id="bk_map". JS should capture it. I will update JS to capture it too.

$visit_date = $conn->real_escape_string($input['data']['date'] ?? '');
$visit_time = $conn->real_escape_string($input['data']['time'] ?? '');

// Insert into database
$sql = "INSERT INTO bookings (location_type, address, landmark, pincode, google_map, visit_date, visit_time, status) 
        VALUES ('$location_type', '$address', '$landmark', '$pincode', '$google_map', '$visit_date', '$visit_time', 'pending')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Booking confirmed']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}

$conn->close();
?>
