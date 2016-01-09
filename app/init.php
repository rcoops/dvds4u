<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'profile_functions.php';

if(session_status() === PHP_SESSION_NONE) {                      // Only start a new session if not one started
    session_start();
}

$view = new \stdClass();

// Make sure the widget refreshes the basket on any page (e.g. checkout page)
if(isset($_POST['remove'])) {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $_SERVER['PHP_SELF'] . '">';
}