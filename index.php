<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once 'app/core/Controller.php';  
require_once 'app/core/Database.php';    
require_once 'app/core/App.php';        
$app = new App();
