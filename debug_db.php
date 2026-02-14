<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/db_connection.php';
echo "Database connection successful.<br>";
$tables = ['products', 'services', 'bookings', 'quotes'];

foreach ($tables as $table) {
    echo "Checking table: $table... ";
    $sql = "SELECT COUNT(*) as count FROM $table";
    $result = $conn->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        echo "Found " . $row['count'] . " rows.<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}
$conn->close();
?>
