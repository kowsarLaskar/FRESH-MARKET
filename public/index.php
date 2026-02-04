<?php
// public/index.php
session_start(); // <--- ADD THIS LINE AT THE TOP

require_once '../app/helpers/session_helpers.php'; // <--- ADD THIS LINE TO LOAD THE SESSION HELPER
require_once '../app/helpers/admin_helpers.php';


// 1. Load the Configuration
require_once '../app/config/config.php';

// 2. Load the Core Libraries (The Engine)
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Core.php'; // The Router

// 3. Start the App
// This triggers the Router, which finds the 'Pages' controller
$init = new Core();