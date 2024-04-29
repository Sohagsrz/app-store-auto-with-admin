<?php
// error_reporting(E_ERROR | E_PARSE);
 
session_start();
define('app_dir', __dir__);
 
//start the application
require app_dir.'/vendor/autoload.php';

require app_dir.'/includes/app.php';