<?php
/**
 * CSRF Token Handler
 * Provides CSRF protection for all forms
 */

if (!isset($_SESSION)) {
    session_start();
}

/**
 * Generate a CSRF token
 * 
 * @return string The generated token
 */
function generateCSRFToken() {
    // Generate a random token if it doesn't exist or is expired
    if (!isset($_SESSION['csrf_token']) || !isset($_SESSION['csrf_token_time'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['csrf_token_time'] = time();
    } else {
        // Check if token is older than 1 hour (3600 seconds)
        if (time() - $_SESSION['csrf_token_time'] > 3600) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $_SESSION['csrf_token_time'] = time();
        }
    }
    
    return $_SESSION['csrf_token'];
}

/**
 * Validate a CSRF token
 * 
 * @param string $token The token to validate
 * @return bool True if valid, false otherwise
 */
function validateCSRFToken($token) {
    // Check if token exists in session
    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }
    
    // Check if token has expired (1 hour)
    if (!isset($_SESSION['csrf_token_time']) || (time() - $_SESSION['csrf_token_time'] > 3600)) {
        return false;
    }
    
    // Validate token using timing-safe comparison
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Get CSRF token for form inclusion
 * Generates if doesn't exist
 * 
 * @return string The CSRF token
 */
function getCSRFToken() {
    return generateCSRFToken();
}

/**
 * Generate CSRF hidden input field HTML
 * 
 * @return string HTML for hidden input field
 */
function getCSRFField() {
    $token = generateCSRFToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}

/**
 * Regenerate CSRF token (call after successful form submission)
 */
function regenerateCSRFToken() {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_token_time'] = time();
}
