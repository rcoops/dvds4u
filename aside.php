<?php

if(basename($_SERVER['PHP_SELF']) != 'register.php') {          // Show login widget on every page but register
    require_once 'app/widgets/login.php';
}
if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {      // Show admin widget only if user is admin
    require_once 'app/widgets/admin.php';
}
if(isset($_SESSION['user_id'])) {                               // Show basket if user is logged in
    require_once 'app/widgets/basket.php';
}