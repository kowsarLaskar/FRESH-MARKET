<?php
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'fresh_market_db'); 
define('DB_PORT', '3307');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));

// URL Root (Dynamic links)
define('URLROOT', 'http://localhost/FRESH-MARKET/public');

// Site Name
define('SITENAME', 'Fresh Market');

// Currency
define('CURRENCY', '₹');

// Delivery Settings
define('DRIVER_COMMISSION', 40.00); // Amount paid to driver per delivered order