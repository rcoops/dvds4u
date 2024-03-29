<?php

require_once 'app/init.php';

$view->pageTitle = 'Verify Account';

if(!empty($_GET)) {                                 // Retrieve necessary account info from GET
    $email = $_GET['email'];
    $hash = $_GET['hash'];
    $usersTable = new \dvds4u\UsersTable();
    $user = $usersTable->fetchByEmail($email);
    if($user && $hash === $user->__get('hash')) {   // User is in db and the two hashes match
        $usersTable->activateAccount($email);
        $view->email = $email;
    }
}
if(isset($_SESSION['user_id'])) {
    header("Location:index.php");
}

if(isset($_POST['resend'])) {                       // Resends the email with the session variables
    $email = new \dvds4u\Emailer($_SESSION['ver_email'], $_SESSION['ver_hash']);
    $email->sendEmail();
}

require_once 'views/verify.php';