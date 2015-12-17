<?php
define("ROOT", __DIR__ . '/');
define("HTTP", $_SERVER['HTTP_HOST'] . '/DvdRental/');

require_once 'app/init.php';

$view = new stdClass();
$view->pageTitle = 'DVDs 4 U';

require 'views/index.php';