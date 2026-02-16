-- ============================================
-- Wavelength Enterprise Site - Database Schema
-- Form Submissions & Rate Limiting System
-- ============================================

-- Drop existing tables if they exist (for clean reinstall)
DROP TABLE IF EXISTS `rate_limit_log`;
DROP TABLE IF EXISTS `form_submissions`;

-- ============================================
-- Table: form_submissions
-- Purpose: Store all form submissions with metadata
-- ============================================
CREATE TABLE `form_submissions` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `form_type` ENUM('booking', 'contact', 'query', 'quote') NOT NULL,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `mobile` VARCHAR(10) NOT NULL,
  `subject` VARCHAR(200) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `additional_data` JSON DEFAULT NULL COMMENT 'Store form-specific fields (date, time, service, etc.)',
  `ip_address` VARCHAR(45) NOT NULL COMMENT 'IPv4 or IPv6 address',
  `user_agent` TEXT DEFAULT NULL,
  `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `email_sent` BOOLEAN DEFAULT FALSE,
  `admin_notified` BOOLEAN DEFAULT FALSE,
  `customer_notified` BOOLEAN DEFAULT FALSE,
  
  -- Indexes for performance
  INDEX `idx_form_type` (`form_type`),
  INDEX `idx_email` (`email`),
  INDEX `idx_submitted_at` (`submitted_at`),
  INDEX `idx_ip_address` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Table: rate_limit_log
-- Purpose: Track submission attempts for rate limiting
-- ============================================
CREATE TABLE `rate_limit_log` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `ip_address` VARCHAR(45) NOT NULL,
  `form_type` VARCHAR(50) NOT NULL,
  `attempt_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `blocked` BOOLEAN DEFAULT FALSE COMMENT 'Was this attempt blocked?',
  
  -- Indexes for performance
  INDEX `idx_ip_form` (`ip_address`, `form_type`),
  INDEX `idx_attempt_time` (`attempt_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Sample Queries for Testing
-- ============================================

-- View all submissions
-- SELECT * FROM form_submissions ORDER BY submitted_at DESC;

-- View submissions by form type
-- SELECT * FROM form_submissions WHERE form_type = 'contact' ORDER BY submitted_at DESC;

-- View rate limit attempts for an IP
-- SELECT * FROM rate_limit_log WHERE ip_address = '127.0.0.1' ORDER BY attempt_time DESC;

-- Count submissions by form type
-- SELECT form_type, COUNT(*) as total FROM form_submissions GROUP BY form_type;

-- View recent blocked attempts
-- SELECT * FROM rate_limit_log WHERE blocked = TRUE ORDER BY attempt_time DESC LIMIT 20;

-- Clean up old rate limit logs (older than 24 hours)
-- DELETE FROM rate_limit_log WHERE attempt_time < DATE_SUB(NOW(), INTERVAL 24 HOUR);

-- ============================================
-- Auto-cleanup Event (Optional)
-- Automatically delete old rate limit logs
-- ============================================

-- Enable event scheduler (run once)
-- SET GLOBAL event_scheduler = ON;

-- Create cleanup event
DELIMITER $$
CREATE EVENT IF NOT EXISTS cleanup_rate_limit_logs
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
BEGIN
  DELETE FROM rate_limit_log 
  WHERE attempt_time < DATE_SUB(NOW(), INTERVAL 7 DAY);
END$$
DELIMITER ;

-- ============================================
-- Verification Queries
-- ============================================

-- Verify tables created
SHOW TABLES LIKE '%form%';
SHOW TABLES LIKE '%rate%';

-- Verify table structure
DESCRIBE form_submissions;
DESCRIBE rate_limit_log;

-- Verify indexes
SHOW INDEX FROM form_submissions;
SHOW INDEX FROM rate_limit_log;
