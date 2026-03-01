<?php
// Simple script to execute a `.sql` file
$host = 'localhost';
$user = 'root';
$pass = '';

echo "Connecting to MySQL server...\n";
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\nMake sure MySQL is running in XAMPP!");
}
echo "Connected successfully to MySQL server.\n";

$sqlFile = 'C:\Users\asus\.gemini\antigravity\brain\992c8479-70ed-4039-a7f1-f25e68e83eca\new_database_schema.sql';
if (!file_exists($sqlFile)) {
    die("SQL file not found at: $sqlFile\n");
}

echo "Reading SQL file...\n";
$sql = file_get_contents($sqlFile);

echo "Executing SQL script...\n";
if ($conn->multi_query($sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo "Database migrated successfully!\n";
} else {
    echo "Error executing script: " . $conn->error . "\n";
}

$conn->close();
