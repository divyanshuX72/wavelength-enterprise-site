<?php
// router.php - Used ONLY for local development with php -S
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// If the requested resource exists as a physical file or directory, serve it as-is
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Clean up slashes for Windows compatibility
$cleanUri = ltrim($uri, '/');
$phpFile = __DIR__ . DIRECTORY_SEPARATOR . $cleanUri . '.php';

if ($cleanUri && file_exists($phpFile)) {
    require $phpFile;
    return true;
}

// Otherwise, fall back to index.php
require __DIR__ . '/index.php';
