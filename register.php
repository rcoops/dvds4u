<?php

require_once 'app/init.php';

$view->pageTitle = 'Register';

// Post only used to submit user details here
if(!empty($_POST)) {                                                    // Nothing if no submit
    $usersTable         = new \dvds4u\UsersTable();
    $view->newUser      = filterArray($_POST);
    $confirmEmail       = $_POST['email_confirm'];
    $confirmPassword    = $_POST['password_confirm'];

    if(isError($view->newUser, $confirmEmail, $confirmPassword)) {
        $view->errorMessage = 'You\'ve got something wrong! :';
        if(hasEmptyField($view->newUser)) {                                   // All fields must be completed
            $view->errors[] = 'All required fields must be entered!';
        }
        if(passLengthInvalid($view->newUser['password'])) {                 // Password too short/long
            $view->errors[] = 'Your password must between 8 and 20 characters.';
        }
        if(fieldsDontMatch($view->newUser['email'], $confirmEmail)) {    // Confirm e-mail doesn't match
            $view->errors[] = 'Your emails don\'t match.';
        }
        if(fieldsDontMatch($view->newUser['password'], $confirmPassword)) {  // Confirm pass doesn't match
            $view->errors[] = 'Your passwords don\'t match.';
        }
    } else {
        if($usersTable->fetchByEmail($view->newUser['email'])) {        // Already in DB
            $view->error = 'You\'re already signed up under that email!';
        } else {
            $usersTable->addUser($view->newUser);
            sendEmail($view->newUser['email'], $usersTable);
            header("Location:verify.php");                              // Redirect for activation
        }
    }
}

require_once 'views/register.php';


// Sends the verification e-mail
function sendEmail($email, $usersTable)
{
    $user = $usersTable->fetchByEmail($email);
    $_SESSION['ver_email'] = $user->__get('email');
    $_SESSION['ver_hash'] = $user->__get('hash');
    $email = new \dvds4u\Emailer($_SESSION['ver_email'], $_SESSION['ver_hash']);
    $email->sendEmail();
}