<?php

require_once 'app/init.php';
$view->pageTitle = 'Change Password';

$usersTable = new \dvds4u\UsersTable();
$user = $usersTable->fetchByPrimaryKey($_SESSION['user_id']);

if(isset($_POST)) {
    if(isset($_POST['password'])) {
        if(password_verify($_POST['password'], $user->__get('pass'))) {
            $view->verified = true;
        } else {
            $view->error = "That's not the correct password for this account!";
        }
    } else if(isset($_POST['new_pass'])) {
        $newPass = $_POST['new_pass'];
        $confPass = $_POST['conf_pass'];
        $passLength = strlen($newPass);
        if($passLength < 8 || $passLength > 16) {                                                  // Check size
            $view->error = "Your password must between 8 and 16 characters.";
        } else if($newPass !== $confPass) {
            $view->error = "Your passwords don't match. Please try again.";
        } else {
            $usersTable->updatePassword($_SESSION['user_id'], $newPass);
            $view->success = 'Your Password has been successfully updated.';
        }
    }
}

//if(!empty($_POST)) {
//    $usersTable = new \dvds4u\UsersTable();
//    $user = $usersTable->fetchByPrimaryKey($_SESSION['user_id']);
//    if(isset($view->verified) && $view->verified) {
//        if(isset($_POST['new_pass'])) {
//            $newPass = $_POST['new_pass'];
//            $confPass = $_POST['conf_pass'];
//            $passLength = strlen($newPass);
//            if($passLength < 8 || $passLength > 16) {                                                  // Check size
//                $view->error = "Your password must between 8 and 16 characters.";
//            } else if($newPass !== $confPass) {
//                $view->error = "Your passwords don't match. Please try again.";
//            } else {
//                $usersTable->updatePassword($_SESSION['user_id'], $newPass);
//                $view->success = 'Your Password has been successfully updated.';
//            }
//        }
//    } else {
//        if(password_verify($_POST['password'], $user->__get('pass'))) {
//            $view->verified = true;
//        } else {
//            $view->error = "That's not the correct password for this account!";
//        }
//    }
//}

require_once 'views/change_pass.php';