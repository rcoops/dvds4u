<?php

require_once 'app/init.php';

$view->pageTitle = 'Edit Profile';

$usersTable = new \dvds4u\UsersTable();
$user       = $usersTable->fetchByPrimaryKey($_SESSION['user_id']);
$view->user = entityToProfile($user);

if(isset($_POST['submit'])) {                                   // Nothing if no submit
    $tempUser = filterArray($_POST);
    if(hasEmptyField($tempUser)) {                                    // All fields must be completed
        $view->user     = filterArray($_POST);
        $view->error    = 'All required fields must be entered!';
    } else {
        $view->user = $tempUser;
        $usersTable->updateProfile($user->__get('id'), $tempUser);
        $view->success = 'Your profile has been updated!';
        if(isset($_POST['nick_name'])) {                        // Update nickname
            if(empty($_POST['nick_name'])) {
                $_SESSION['name'] = $user->__get('email');
            } else {
                $_SESSION['name'] = $_POST['nick_name'];
            }
        }
    }
}

require_once 'views/profile.php';

// Retrieves relevant fields from a user entity object
function entityToProfile($user)
{
    return [
        'nick_name'     => $user->__get('nick_name'),
        'address'       => $user->__get('address'),
        'city'          => $user->__get('city'),
        'postcode'      => $user->__get('postcode'),
        'phone_number'  => $user->__get('phone_number'),
    ];
}