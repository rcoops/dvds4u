<?php

require_once 'app/init.php';

$view->pageTitle = 'Change Password';

$usersTable = new \dvds4u\UsersTable();
$user       = $usersTable->fetchByPrimaryKey($_SESSION['user_id']);

if(isset($_POST)) {
    if(isset($_POST['password'])) {
        $entered    = $_POST['password'];
        $actual     = $user->__get('pass');
        if(password_verify($entered, $actual)) {
            $view->verified = true;
        } else {
            $view->errorMessage = "That's not the correct password for this account!";
        }
    } else if(isset($_POST['new_pass'])) {
        $newPass    = $_POST['new_pass'];
        $confPass   = $_POST['conf_pass'];
        $passLength = strlen($newPass);
        if(isPassError($newPass, $confPass)) {
            $view->errorMessage = 'You\'ve got something wrong! :';
            if(passLengthInvalid($newPass)) {                                               // Check size
                $view->errors[] = "Your password must between 8 and 16 characters.";
            }
            if(fieldsDontMatch($newPass, $confPass)) {                                      // Check confirmation
                $view->errors[] = "Your passwords don't match.";
            }
        } else {
            $usersTable->updatePassword($_SESSION['user_id'], $newPass);
            $view->success = 'Your Password has been successfully updated.';
        }
    }
}

require_once 'views/change_pass.php';

function isPassError($orig, $confirm)
{
    return passLengthInvalid($orig) || fieldsDontMatch($orig, $confirm);
}