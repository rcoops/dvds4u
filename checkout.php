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
        rentDVDs($filmsTable, $view);
    }
}

require_once 'views/checkout.php';

function rentDVDs($filmsTable, $view)
{
    foreach($_SESSION['basket'] as $filmId) {
        if($filmId) {                                                   // Ignore our false value
            $film = $filmsTable->fetchByPrimaryKey($filmId);
            $clientId = $film->__get('client_id');
            if($clientId !== null) {
                $view->error = 'I\'m sorry, another user has rented the following DVDs<br />'
                    . 'since you added them to your basket:';
                $view->rentedFilms[] = $film->__get('title');
                $basketIndex = array_search($filmId, $_SESSION['basket']);
                unset($_SESSION['basket'][$basketIndex]);
            } else {
                $filmsTable->updateField($filmId, 'client_id', $_SESSION['user_id']);
                $view->success = 'You have successfully rented your chosen DVDs.<br />'
                    . 'They will arrive within 2 working days... honest.';
                unset($_SESSION['basket']);
            }
        }
    }
}