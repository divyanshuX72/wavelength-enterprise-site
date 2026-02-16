<?php
/**
 * Enhanced Centralized Email Handler
 * Enterprise-grade mail system with security and database logging
 */

require_once __DIR__ . '/../config/email_config.php';
require_once __DIR__ . '/../config/db_connection.php';

/**
 * Send email using PHPMailer
 * 
 * @param array $params Email parameters
 * @return array Response with success status and message
 */
function sendEmail($params) {
    $requiredParams = ['to', 'subject', 'body'];
    foreach ($requiredParams as $param) {
        if (!isset($params[$param])) {
            return [
                'success' => false,
                'message' => "Missing required parameter: $param"
            ];
        }
    }
    
    try {
        $mail = getMailer();
        
        // Recipients
        $mail->addAddress($params['to']);
        
        // Reply-To (optional)
        if (isset($params['replyTo']) && isset($params['replyToName'])) {
            $mail->addReplyTo($params['replyTo'], $params['replyToName']);
        }
        
        // CC (optional)
        if (isset($params['cc'])) {
            if (is_array($params['cc'])) {
                foreach ($params['cc'] as $cc) {
                    $mail->addCC($cc);
                }
            } else {
                $mail->addCC($params['cc']);
            }
        }
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $params['subject'];
        $mail->Body = $params['body'];
        
        // Plain text alternative (optional)
        if (isset($params['altBody'])) {
            $mail->AltBody = $params['altBody'];
        }
        
        // Send
        $mail->send();
        
        return [
            'success' => true,
            'message' => 'Email sent successfully'
        ];
        
    } catch (Exception $e) {
        error_log("Email sending failed: " . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Failed to send email',
            'error' => $e->getMessage()
        ];
    }
}

/**
 * Generate HTML email template with IP address
 * 
 * @param string $title Email title
 * @param array $fields Array of field data ['label' => 'value']
 * @param string $ipAddress IP address of submitter
 * @param string $footer Optional footer text
 * @return string HTML email body
 */
function generateEmailTemplate($title, $fields, $ipAddress = '', $footer = '') {
    $fieldsHtml = '';
    foreach ($fields as $label => $value) {
        $fieldsHtml .= '
        <div class="field">
            <div class="label">' . htmlspecialchars($label) . ':</div>
            <div class="value">' . nl2br(htmlspecialchars($value)) . '</div>
        </div>';
    }
    
    // Add IP address if provided
    if (!empty($ipAddress)) {
        $fieldsHtml .= '
        <div class="field">
            <div class="label">IP Address:</div>
            <div class="value">' . htmlspecialchars($ipAddress) . '</div>
        </div>';
    }
    
    if (empty($footer)) {
        $footer = 'This email was sent from Wavelength Enterprises website.';
    }
    
    return '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #2c1810 0%, #1a0f0a 100%); color: #d4a574; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
            .header h2 { margin: 0; font-size: 24px; }
            .header p { margin: 10px 0 0 0; font-size: 14px; opacity: 0.9; }
            .content { background: #f9f9f9; padding: 30px 20px; border: 1px solid #e0e0e0; border-top: none; }
            .field { margin-bottom: 20px; }
            .label { font-weight: bold; color: #2c1810; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
            .value { margin-top: 8px; padding: 12px; background: white; border-left: 3px solid #d4a574; font-size: 15px; word-wrap: break-word; }
            .footer { text-align: center; margin-top: 20px; padding: 20px; font-size: 12px; color: #666; background: #f0f0f0; border-radius: 0 0 8px 8px; }
            .footer p { margin: 5px 0; }
            .timestamp { color: #999; font-style: italic; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>' . htmlspecialchars($title) . '</h2>
                <p>Wavelength Enterprises</p>
            </div>
            <div class="content">
                ' . $fieldsHtml . '
            </div>
            <div class="footer">
                <p>' . htmlspecialchars($footer) . '</p>
                <p class="timestamp">Received on: ' . date('F j, Y, g:i a') . '</p>
            </div>
        </div>
    </body>
    </html>';
}

/**
 * Generate customer confirmation email template
 * 
 * @param string $customerName Customer's name
 * @param string $formType Type of form (Booking, Contact, Query, Quote)
 * @return string HTML email body
 */
function generateConfirmationEmail($customerName, $formType = 'Contact') {
    return '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #d4a574 0%, #b8935f 100%); color: #1a0f0a; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
            .header h2 { margin: 0; font-size: 24px; }
            .content { background: #f9f9f9; padding: 30px 20px; border: 1px solid #e0e0e0; border-top: none; }
            .content p { margin: 15px 0; font-size: 15px; }
            .highlight { background: white; padding: 15px; border-left: 3px solid #d4a574; margin: 20px 0; }
            .footer { text-align: center; margin-top: 20px; padding: 20px; font-size: 12px; color: #666; background: #f0f0f0; border-radius: 0 0 8px 8px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Thank You!</h2>
            </div>
            <div class="content">
                <p>Dear ' . htmlspecialchars($customerName) . ',</p>
                <p>Thank you for contacting Wavelength Enterprises. We have received your ' . strtolower($formType) . ' request.</p>
                <div class="highlight">
                    <p><strong>What happens next?</strong></p>
                    <p>Our team will review your request and get back to you within 24-48 hours. We appreciate your patience.</p>
                </div>
                <p>If you have any urgent questions, feel free to reach out to us directly:</p>
                <p>📞 Phone: +91 93731 54925<br>
                📧 Email: info@wavelengthenterprises.com</p>
                <p>Best regards,<br>
                <strong>Wavelength Enterprises Team</strong></p>
            </div>
            <div class="footer">
                <p>This is an automated confirmation email.</p>
                <p>&copy; ' . date('Y') . ' Wavelength Enterprises. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>';
}

/**
 * Validate email address
 */
function validateEmail($email) {
    if (empty($email)) {
        return 'Email is required.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email format.';
    }
    if (strlen($email) > 100) {
        return 'Email is too long.';
    }
    return '';
}

/**
 * Validate mobile number (10 digits)
 */
function validateMobile($mobile) {
    if (empty($mobile)) {
        return 'Mobile number is required.';
    }
    if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        return 'Mobile number must be exactly 10 digits.';
    }
    return '';
}

/**
 * Validate required field
 */
function validateRequired($value, $fieldName, $minLength = 2, $maxLength = 200) {
    if (empty($value) || trim($value) === '') {
        return "$fieldName is required.";
    }
    $length = strlen(trim($value));
    if ($length < $minLength) {
        return "$fieldName must be at least $minLength characters.";
    }
    if ($length > $maxLength) {
        return "$fieldName must not exceed $maxLength characters.";
    }
    return '';
}

/**
 * Sanitize input to prevent XSS
 */
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate honeypot field (should be empty)
 * 
 * @param string $value Honeypot field value
 * @return bool True if valid (empty), false if bot detected
 */
function validateHoneypot($value) {
    return empty($value);
}

/**
 * Get client IP address
 * 
 * @return string IP address
 */
function getClientIP() {
    $ipAddress = '';
    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    
    // Handle multiple IPs (take first one)
    if (strpos($ipAddress, ',') !== false) {
        $ipAddress = explode(',', $ipAddress)[0];
    }
    
    return trim($ipAddress);
}

/**
 * IP-based rate limiting check
 * 
 * @param string $formType Form type identifier
 * @param int $cooldownSeconds Cooldown period in seconds
 * @param int $maxAttempts Maximum attempts allowed
 * @return array ['allowed' => bool, 'waitTime' => int, 'attemptsRemaining' => int]
 */
function checkIPRateLimit($formType, $cooldownSeconds = 60, $maxAttempts = 3) {
    global $conn;
    
    $ipAddress = getClientIP();
    $currentTime = time();
    $windowStart = date('Y-m-d H:i:s', $currentTime - $cooldownSeconds);
    
    // Count recent attempts from this IP for this form type
    $stmt = $conn->prepare("
        SELECT COUNT(*) as attempt_count 
        FROM rate_limit_log 
        WHERE ip_address = ? 
        AND form_type = ? 
        AND attempt_time >= ?
    ");
    $stmt->bind_param("sss", $ipAddress, $formType, $windowStart);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $attemptCount = $row['attempt_count'];
    $stmt->close();
    
    if ($attemptCount >= $maxAttempts) {
        // Get time of oldest attempt in window
        $stmt = $conn->prepare("
            SELECT attempt_time 
            FROM rate_limit_log 
            WHERE ip_address = ? 
            AND form_type = ? 
            AND attempt_time >= ?
            ORDER BY attempt_time ASC 
            LIMIT 1
        ");
        $stmt->bind_param("sss", $ipAddress, $formType, $windowStart);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $oldestAttempt = strtotime($row['attempt_time']);
        $stmt->close();
        
        $waitTime = $cooldownSeconds - ($currentTime - $oldestAttempt);
        
        // Log blocked attempt
        $blocked = true;
        $stmt = $conn->prepare("INSERT INTO rate_limit_log (ip_address, form_type, blocked) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $ipAddress, $formType, $blocked);
        $stmt->execute();
        $stmt->close();
        
        return [
            'allowed' => false,
            'waitTime' => max(1, $waitTime),
            'attemptsRemaining' => 0
        ];
    }
    
    // Log this attempt
    $blocked = false;
    $stmt = $conn->prepare("INSERT INTO rate_limit_log (ip_address, form_type, blocked) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $ipAddress, $formType, $blocked);
    $stmt->execute();
    $stmt->close();
    
    return [
        'allowed' => true,
        'attemptsRemaining' => $maxAttempts - $attemptCount - 1
    ];
}

/**
 * Log form submission to database
 * 
 * @param array $data Submission data
 * @return int|false Submission ID or false on failure
 */
function logFormSubmission($data) {
    global $conn;
    
    $formType = $data['form_type'] ?? '';
    $fullName = $data['full_name'] ?? '';
    $email = $data['email'] ?? '';
    $mobile = $data['mobile'] ?? '';
    $subject = $data['subject'] ?? null;
    $message = $data['message'] ?? null;
    $additionalData = isset($data['additional_data']) ? json_encode($data['additional_data']) : null;
    $ipAddress = getClientIP();
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    $stmt = $conn->prepare("
        INSERT INTO form_submissions 
        (form_type, full_name, email, mobile, subject, message, additional_data, ip_address, user_agent) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->bind_param(
        "sssssssss",
        $formType,
        $fullName,
        $email,
        $mobile,
        $subject,
        $message,
        $additionalData,
        $ipAddress,
        $userAgent
    );
    
    if ($stmt->execute()) {
        $submissionId = $stmt->insert_id;
        $stmt->close();
        return $submissionId;
    }
    
    $stmt->close();
    return false;
}

/**
 * Update email sent status in database
 * 
 * @param int $submissionId Submission ID
 * @param bool $adminNotified Admin email sent
 * @param bool $customerNotified Customer email sent
 */
function updateEmailStatus($submissionId, $adminNotified = false, $customerNotified = false) {
    global $conn;
    
    $emailSent = $adminNotified || $customerNotified;
    
    $stmt = $conn->prepare("
        UPDATE form_submissions 
        SET email_sent = ?, admin_notified = ?, customer_notified = ? 
        WHERE id = ?
    ");
    
    $stmt->bind_param("iiii", $emailSent, $adminNotified, $customerNotified, $submissionId);
    $stmt->execute();
    $stmt->close();
}
