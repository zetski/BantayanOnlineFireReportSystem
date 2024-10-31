<?php
// Define constants for local development
if (!defined('base_url')) {
    define('base_url', 'http://localhost/ofrs/');
}
if (!defined('base_app')) {
    define('base_app', str_replace('\\', '/', __DIR__) . '/');
}
if (!defined('DB_SERVER')) {
    define('DB_SERVER', 'localhost');
}
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'ofrs_db');
}

// Establish the connection
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Set character set
mysqli_set_charset($conn, 'utf8');

// Additional error handling (optional)
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}
?>
