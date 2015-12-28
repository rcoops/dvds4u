<?php

require_once 'app/init.php';

$view->pageTitle = 'Edit Profile';
$user = (new \dvds4u\UsersTable())->fetchByPrimaryKey($_SESSION['user_id']);

$view->user = entityToProfile($user);

if(isset($_POST['submit'])) {                                                  // Nothing if no submit
    $tempUser = postToProfile($_POST);
    if(checkEmpty($_POST, $view->user)) {                                      // All fields must be completed
        $view->error = 'All required fields must be entered!';
    } else {
        $view->user = $tempUser;
        $usersTable = new \dvds4u\UsersTable();
        $usersTable->updateProfile($tempUser);
        $view->success = 'Your profile has been updated!';
    }
}

function postToProfile($array)
{
    foreach($array as $key => $value) {
        switch($key) {
            case 'id':
            case 'first_name':
            case 'address':
            case 'city':
            case 'postcode':
            case 'phone_number':
                $user[$key] = $value;
                break;
        }
    }
    return $user;
}

function entityToProfile($user)
{
    $arrUser['id'] = $user->__get('id');
    $arrUser['first_name'] = $user->__get('first_name');
    $arrUser['address'] = $user->__get('address');
    $arrUser['city'] = $user->__get('city');
    $arrUser['postcode'] = $user->__get('postcode');
    $arrUser['phone_number'] = $user->__get('phone_number');

    return $arrUser;
}

function checkEmpty($fields, $orig)
{
    $empty = false;
    foreach($fields as $key => $value) {
        if($key !== 'first_name' && $key !== 'submit' && !$value) {                 // First name can be empty and
            $empty = true;                                                          // submit should be ignored
            $fields[$key] = $orig[$key];
        }
    }

    return $empty;
}


require_once 'views/profile.php';