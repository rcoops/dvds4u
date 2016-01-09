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