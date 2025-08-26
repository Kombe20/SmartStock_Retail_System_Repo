<?php
// Application configuration
define('APP_NAME', 'SmartStock Retail System');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'http://localhost/smartstock/');

// File paths
define('INCLUDE_PATH', __DIR__ . '/../includes/');
define('UPLOAD_PATH', __DIR__ . '/../uploads/');

// Inventory settings
define('LOW_STOCK_THRESHOLD', 10);
define('REORDER_LEVEL_MULTIPLIER', 1.5);

// System settings
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>