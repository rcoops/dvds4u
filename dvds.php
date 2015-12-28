<?php

require_once 'app/init.php';

$view->pageTitle = 'Store';
$view->films = [];
$view->selected = [];

$filmsTable = new \dvds4u\FilmsTable();
$films = $filmsTable->fetchAllEntities();

foreach($films as $film) {
    $view->years[] = $film->__get('year_of_release');
}
$view->years = array_unique($view->years);
sort($view->years);
array_unshift($view->years, '');                                                    // For choosing nothing

$genresTable = new \dvds4u\GenresTable();
$genres = $genresTable->fetchAllEntities();
$view->genres[] = '';                                                               // For choosing nothing

foreach($genres as $genre) {
    $view->genres[] = $genre->__get('genre');
}

$directorsTable = new \dvds4u\DirectorsTable();
$directors = $directorsTable->fetchAllEntities();
$view->directors[] = '';                                                            // For choosing nothing

foreach($directors as $director) {
    $view->directors[] =  $director->__get('surname') . ', ' . $director->__get('first_name');
}

$view->prices = ['', 'A - £3.50', 'B - £2.50', 'C - £1.00'];

if(isset($_POST) && !isset($_POST['add'])) {                                        // Don't filter for add post
    foreach($_POST as $key => $value) {
        if($key !== 'clear') {                                                      // Ignore clear
            if($key === 'price') {
                switch($value) {
                    case 'A - £3.50':
                        $dbValue = 1;
                        break;
                    case 'B - £2.50':
                        $dbValue = 2;
                        break;
                    case 'C - £1.00':
                        $dbValue = 3;
                        break;
                }
                if(isset($dbValue)) {
                    $filters[$key] = $dbValue;
                }
            } else {
                $filters[$key] = $value;
            }
            $view->selected[$key] = $value;
        }
    }

    if(isset($_POST['clear'])) {
        foreach($view->selected as $key => $value) {
            unset($view->selected[$key]);
        }
        unset($_POST);
        header('Refresh:0');
    }

    if(isset($filters)) {
        $films = $filmsTable->fetchFilteredFilms($filters);
    }
}

foreach($films as $film) {                                                          // Do this last in case of filters
    $view->films[] = [
        'id' => $film->__get('id'),
        'title' => $film->__get('title'),
        'picture' => $film->__get('picture'),
        'rentable' => (isset($_SESSION['user_id']) && !$film->__get('client_id')),  // Logged in and no client_id
        'url' => 'dvd.php?fid=' . $film->__get('id'),
        // ************ SWITCH TO THIS IF USING BLOBS ************
//        'url' => 'dvds.php?title=' . strtolower(str_replace(' ', '_', $film->__get('title'))),
    ];
}

if(isset($_POST['add'])) {
    $_SESSION['basket'][0] = false;                                                 // Must fill this as array_search...
    if(array_search($_POST['film_id'], $_SESSION['basket']) === false) {            // returns index (0) on success
        $_SESSION['basket'][] = $_POST['film_id'];
        $view->success = 'Added to basket';
    } else {
        $view->error = 'Already in basket'  ;
    }
}

require_once 'views/dvds.php';