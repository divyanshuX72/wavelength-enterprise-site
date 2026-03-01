<?php
// Simple script to insert broken images
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'wavelength_v2';

echo "Connecting to MySQL server...\n";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`) VALUES
(1, 'frontend/images/ai_tv_unit_1770204842451.png', 1),
(2, 'frontend/images/ai_bed_modern_1770204864113.png', 1),
(3, 'frontend/images/ai_wardrobe_sleek_1770204884623.png', 1)
ON DUPLICATE KEY UPDATE `image_path` = VALUES(`image_path`);
";

if ($conn->query($sql) === TRUE) {
    echo "Images inserted successfully.\n";
} else {
    echo "Error inserting images: " . $conn->error . "\n";
}

$conn->close();
