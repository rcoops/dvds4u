<?php

namespace dvds4u;

define("ROOT", __DIR__ . '/');
define("HTTP", $_SERVER['HTTP_HOST'] . '/DvdRental/');

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../vendor/autoload.php';

$view = new \stdClass(); // Think about this for different pages

//    foreach($view->clientsTable as $clientData) {
//        echo "<tr>"
//            . "<td> {$clientData->__get('email')} </td>"
//            . "<td> {$clientData->__get('first_name')} </td>"
//            . "<td> {$clientData->__get('address')} </td>"
//            . "<td> {$clientData->__get('city')} </td>"
//            . "<td> {$clientData->__get('postcode')} </td>"
//            . "<td> {$clientData->__get('phone_number')} </td>"
//            . "</tr>";
//    }