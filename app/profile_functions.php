<?php

// Returns true if there are any empty required fields, the password length is too short or long,
// or if either email or password don't match their confirmation fields.
function isError($user, $confirmEmail, $confirmPass)
{
    $email  = $user['email'];
    $pass   = $user['password'];
    return hasEmptyField($user)
        || passLengthInvalid($pass)
        || fieldsDontMatch($email, $confirmEmail)
        || fieldsDontMatch($pass, $confirmPass);
}

// Returns true if paramater's length is less or more than two arbitrary values
function passLengthInvalid($pass)
{
    $min        = 8;
    $max        = 20;
    $passLength = strlen($pass);
    return $passLength < $min
        || $passLength > $max;
}

// Returns true if the two parameters dont match (used for email/password + confirm)
function fieldsDontMatch($orig, $confirm)
{
    return $orig !== $confirm;
}

// Returns true if the array has a required field with no value (empty string)
function hasEmptyField($user)
{
    $empty = false;
    foreach($user as $key => $value) {
        if ($key !== 'nick_name' && empty($value)) {
            $empty = true;
        }
    }
    return $empty;
}

// Removes redundant information from an input (POST) array
function filterArray($array)
{
    $filtered = [];
    // Used for register & profile - profile doesn't use these 2 fields
    if(isset($array['email'])) {
        $filtered['email']      = $array['email'];
    }
    if(isset($array['password'])) {
        $filtered['password']   = $array['password'];
    }
    // May or may not include this field
    if(isset($array['nick_name'])) {
        $filtered['nick_name']  = $array['nick_name'];
    }
    $filtered['address']        = $array['address'];
    $filtered['city']           = $array['city'];
    $filtered['postcode']       = $array['postcode'];
    $filtered['phone_number']   = $array['phone_number'];
    return $filtered;
}