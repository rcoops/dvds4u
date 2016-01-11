<?php

/* Profile/register/change_pass */

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

/* Basket / checkout */

function getTotal($priceBands)
{
    $total = 0;
    if(!empty($priceBands)) {
        foreach($priceBands as $priceBand) {
            if($priceBand == 1) {
                $total += 3.5;
            } else if($priceBand == 2) {
                $total += 2.5;
            } else if($priceBand == 3) {
                $total += 1;
            } else {
                return 'Error - undefined price band!';                 // Error message if not known
            }
        }
    }
    // If contains a decimal point will return the string (also a positive)
    if(strstr($total, '.')) {
        $total = '£' . $total . '0';
    } else {
        $total = '£' . $total . '.00';
    }
    return $total;
}

// Whether the user is logged in and film is not rented
function isRentable($film)
{
    $loggedIn   = isset($_SESSION['user_id']);
    $rented     = !$film->__get('client_id');
    return ($loggedIn && $rented);
}

function getStrPrice($film)
{
    $priceBand  = $film->__get('price_band');
    $strPrice   = 'Error - undefined price-band!';                      // Error message if not from our known set
    if($priceBand == 1) {
        $strPrice = '£3.50';
    } else if($priceBand == 2) {
        $strPrice = '£2.50';
    } else if($priceBand == 3) {
        $strPrice = '£1.00';
    }
    return $strPrice;
}