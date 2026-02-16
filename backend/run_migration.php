<?php

/**
 * Database Migration Script
 * Run this file once to create the required tables
 */

require_once __DIR__ . '/config/db_connection.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Database Migration - Wavelength Enterprise</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        h1 { color: #2c1810; }
        .success { color: #28a745; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin: 10px 0; }
        .error { color: #721c24; padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; margin: 10px 0; }
        .info { color: #004085; padding: 10px; background: #cce5ff; border: 1px solid #b8daff; margin: 10px 0; }
        pre { background: #f5f5f5; padding: 10px; border-left: 3px solid #d4a574; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>Database Migration</h1>
";

$successCount = 0;
$errorCount = 0;

echo '<div class="info">📊 Creating database tables...</div>';

// Create form_submissions table
$sql1 = "CREATE TABLE IF NOT EXISTS `form_submissions` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `form_type` ENUM('booking', 'contact', 'query', 'quote') NOT NULL,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `mobile` VARCHAR(10) NOT NULL,
  `subject` VARCHAR(200) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `additional_data` JSON DEFAULT NULL COMMENT 'Store form-specific fields',
  `ip_address` VARCHAR(45) NOT NULL COMMENT 'IPv4 or IPv6 address',
  `user_agent` TEXT DEFAULT NULL,
  `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `email_sent` BOOLEAN DEFAULT FALSE,
  `admin_notified` BOOLEAN DEFAULT FALSE,
  `customer_notified` BOOLEAN DEFAULT FALSE,
  INDEX `idx_form_type` (`form_type`),
  INDEX `idx_email` (`email`),
  INDEX `idx_submitted_at` (`submitted_at`),
  INDEX `idx_ip_address` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($conn->query($sql1)) {
    echo '<div class="success">✅ Created table: form_submissions</div>';
    $successCount++;
} else {
    echo '<div class="error">❌ Error creating form_submissions: ' . htmlspecialchars($conn->error) . '</div>';
    $errorCount++;
}

// Create rate_limit_log table
$sql2 = "CREATE TABLE IF NOT EXISTS `rate_limit_log` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `ip_address` VARCHAR(45) NOT NULL,
  `form_type` VARCHAR(50) NOT NULL,
  `attempt_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `blocked` BOOLEAN DEFAULT FALSE COMMENT 'Was this attempt blocked?',
  INDEX `idx_ip_form` (`ip_address`, `form_type`),
  INDEX `idx_attempt_time` (`attempt_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($conn->query($sql2)) {
    echo '<div class="success">✅ Created table: rate_limit_log</div>';
    $successCount++;
} else {
    echo '<div class="error">❌ Error creating rate_limit_log: ' . htmlspecialchars($conn->error) . '</div>';
    $errorCount++;
}

// Create cleanup event (optional)
$sql3 = "CREATE EVENT IF NOT EXISTS cleanup_rate_limit_logs
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
DELETE FROM rate_limit_log WHERE attempt_time < DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($conn->query($sql3)) {
    echo '<div class="success">✅ Created cleanup event</div>';
    $successCount++;
} else {
    // Event creation might fail if event scheduler is disabled - that's okay
    if (stripos($conn->error, 'event scheduler') !== false) {
        echo '<div class="info">ℹ️ Event scheduler disabled (optional feature)</div>';
    } else {
        echo '<div class="error">❌ Error creating event: ' . htmlspecialchars($conn->error) . '</div>';
    }
}

echo '<h2>Migration Summary</h2>';
echo '<div class="info">';
echo '✅ Successful: ' . $successCount . '<br>';
echo '❌ Errors: ' . $errorCount . '<br>';
echo '</div>';

// Verify tables
echo '<h2>Verification</h2>';

$tables = ['form_submissions', 'rate_limit_log'];
foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result && $result->num_rows > 0) {
        echo '<div class="success">✅ Table exists: ' . $table . '</div>';

        // Show table structure
        $result = $conn->query("DESCRIBE $table");
        if ($result) {
            echo '<pre>';
            echo "Structure of $table:\n";
            while ($row = $result->fetch_assoc()) {
                echo sprintf("%-20s %-20s %s\n", $row['Field'], $row['Type'], $row['Null']);
            }
            echo '</pre>';
        }
    } else {
        echo '<div class="error">❌ Table missing: ' . $table . '</div>';
    }
}

echo '<h2>Next Steps</h2>';
echo '<div class="info">';
echo '1. ✅ Database schema created<br>';
echo '2. 📝 Update .env with SMTP credentials<br>';
echo '3. 🧪 Test form submissions<br>';
echo '4. 🔒 Delete this migration file for security<br>';
echo '</div>';

echo '<p><strong>⚠️ Important:</strong> Delete this file (run_migration.php) after successful migration for security reasons.</p>';

echo '</body></html>';

$conn->close();
