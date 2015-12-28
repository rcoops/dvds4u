<?php
if(basename($_SERVER['PHP_SELF']) != 'register.php') {
    require_once 'app/widgets/login.php';
}
if(isset($_SESSION['user_id'])) {
    require_once 'app/widgets/basket.php';
}
if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    require_once 'app/widgets/admin.php';
}