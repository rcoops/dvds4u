<?php

require_once 'app/init.php';

$view->pageTitle = 'Basket';

if(isset($_SESSION['basket'])) {
    $view->basket = [];
    $view->total = 0;
    $filmsTable = new \dvds4u\FilmsTable();

    foreach($_SESSION['basket'] as $filmId) {
        if($filmId) {
            $film = $filmsTable->fetchByPrimaryKey($filmId);
            $arrFilm['title'] = $film->__get('title');
            $arrFilm['picture'] = $film->__get('picture');
            $price = $film->__get('price_band');
            switch($price) {
                case 1:
                    $arrFilm['price'] = '£3.50';
                    $view->total += 3.5;
                    break;
                case 2:
                    $arrFilm['price'] = '£2.50';
                    $view->total += 2.5;
                    break;
                default:                                                // Set as default to ensure a price is set
                    $arrFilm['price'] = '£1.00';
                    $view->total += 1;
                    break;
            }
            $view->basket[$filmId] = $arrFilm;
        }
    }

    if(strlen($view->total) === 1) {
        $view->total = '£' . $view->total . '.00';
    } else {
        $view->total = '£' . $view->total . '0';
    }
    if(isset($_POST['rent'])) {
        foreach($_SESSION['basket'] as $filmId) {
            if($filmId){                                                // Ignore our false value
                $filmsTable->updateField($filmId, $filmsTable->getClientField(), $_SESSION['user_id']);
            }
        }
        unset($_SESSION['basket']);
        $view->success = 'You have successfully rented your chosen DVDs.<br />They will arrive within 5 working days... honest.';
    }
}

require_once 'views/basket.php';