<?php

if(isset($_SESSION['basket'])) {
    $view->film     = [];
    $view->total    = 0;
    $filmsTable     = new \dvds4u\FilmsTable();
    $priceBands = [];
    if(isset($_POST['remove'])) {
        $index = array_search($_POST['film_id'], $_SESSION['basket']);
        unset($_SESSION['basket'][$index]);
    }

    foreach($_SESSION['basket'] as $filmId) {
        if($filmId) {
            $film = $filmsTable->fetchByPrimaryKey($filmId);
            $arrFilm['title']   = $film->__get('title');
            $arrFilm['price']   = getStrPrice($film);
            $priceBands[]       = $film->__get('price_band');
            $view->film[$filmId] = $arrFilm;
        }
    }

    $view->total = getTotal($priceBands);
}

require_once 'views/widgets/basket.php';