<?php

require_once 'app/init.php';

$view->pageTitle = 'Register';
if(!empty($_POST)) {                                                            // Nothing if no submit
    $view->newUser = createNewUserArray();
    $confirmEmail = $_POST['email_confirm'];
    $confirmPassword = $_POST['password_confirm'];
    $passLength = strlen($_POST['password']);
    $emptyField = false;
    foreach($view->newUser as $key => $value) {
        if($key !== 'firstName' && $value === '') {
            $emptyField = true;
        }
    }
    if($emptyField) {                                      // All fields must be completed
        $view->error = 'All required fields must be entered!';
    } else if($passLength < 8 || $passLength > 16) {                            // Password too short/long
        $view->error = "Your password must between 8 and 16 characters.";
    } else if($view->newUser['email'] !== $confirmEmail) {                      // Confirm e-mail doesn't match
        $view->error = "Your emails don't match. Please try again.";
    } else if($view->newUser['pass'] !== $confirmPassword) {             // Confirm pass doesn't match
        $view->error = "Your passwords don't match. Please try again.";
    } else {
        $usersTable = new \dvds4u\UsersTable();
        if($usersTable->fetchByEmail($view->newUser['email'])) {                // Already in DB
            $view->error = "You're already signed up under that email!";
        } else {
            $usersTable->addUser($view->newUser);
            sendEmail($view->newUser['email'], $usersTable);
            header("Location:verify.php");
        }
    }
}
require_once 'views/register.php';

function createNewUserArray()
{
    return [
        'email' => $_POST['email'],
        'firstName' => $_POST['first_name'],
        'pass' => $_POST['password'],
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'postcode' => $_POST['postcode'],
        'phoneNumber' => $_POST['phone_number'],
    ];
}

function sendEmail($email, $usersTable)
{
    $user = $usersTable->fetchByEmail($email);
    $_SESSION['ver_email'] = $user->__get('email');
    $_SESSION['ver_hash'] = $user->__get('hash');
    $email = new \dvds4u\Emailer($_SESSION['ver_email'], $_SESSION['ver_hash']);
    $email->sendEmail();
}