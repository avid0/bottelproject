<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('error_log', '../error_log');

// composer autoload
require_once "../vendor/autoload.php";

// config
require_once "../config/boot.php";

// Bot
require_once "bot.php";

?>
