<?php

require_once 'app/init.php';

if(isset($_SESSION['basket'])) {
    $view->film = [];
    $view->total = 0;
    $filmsTable = new \dvds4u\FilmsTable();

    foreach($_SESSION['basket'] as $filmId) {
        if($filmId) {
            $film = $filmsTable->fetchByPrimaryKey($filmId);
            $arrFilm['title'] = $film->__get('title');
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
            $view->film[$filmId] = $arrFilm;

        }
    }

    if(strlen($view->total) === 1) {
        $view->total = '£' . $view->total . '.00';
    } else {
        $view->total = '£' . $view->total . '0';
    }

    if(isset($_POST['remove'])) {
        $index = array_search($_POST['film_id'], $_SESSION['basket']);
        unset($_SESSION['basket'][$index]);
    }
}

require_once 'views/widgets/basket.php';