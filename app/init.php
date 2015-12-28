<?php

namespace dvds4u;

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../vendor/autoload.php';

$view = new \stdClass();

if(isset($_POST['logout'])) {
    header('Location:index.php');
} else if(isset($_POST['login']) || isset($_POST['remove'])) { // Make sure the widget updates the page everywhere
    header('Refresh:0');
}