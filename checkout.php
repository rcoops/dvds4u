<?php

require_once 'app/init.php';

$view->pageTitle = 'Checkout';

if(isset($_SESSION['basket'])) {
    $filmsTable     = new \dvds4u\FilmsTable();
    $priceBands     = [];
    $view->basket   = [];
    foreach($_SESSION['basket'] as $filmId) {
        // Ignore our false value (would not work with 0 indexing)
        if($filmId) {
            $film                   = $filmsTable->fetchByPrimaryKey($filmId);
            $view->basket[$filmId]  = [
                'title' => $film->__get('title'),
                'image' => base64_encode($film->__get('image')),
                'price' => getStrPrice($film),
            ];
            $priceBands[] = $film->__get('price_band');
        }
    }
    $view->total = getTotal($priceBands);
    if(isset($_POST['rent'])) {
        $view->success = rentDVDs($filmsTable);
    }
}

require_once 'views/checkout.php';

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

function rentDVDs($filmsTable)
{
    foreach($_SESSION['basket'] as $filmId) {
        if($filmId) {                                                   // Ignore our false value
            $filmsTable->updateField($filmId, 'client_id', $_SESSION['user_id']);
        }
    }
    unset($_SESSION['basket']);
    return 'You have successfully rented your chosen DVDs.<br />They will arrive within 2 working days... honest.';
}