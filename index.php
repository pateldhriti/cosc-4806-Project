<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session early
session_start();

// Load core classes
require_once 'app/core/Database.php';
require_once 'app/core/Controller.php';
require_once 'app/core/App.php'; // ✅ This is where the App class is defined

// Run the application
$app = new App();
