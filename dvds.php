<?php

require_once 'app/init.php';

$view->pageTitle = 'Store';

$view->films        = [];
$view->years        = [];                                                           // For choosing nothing
$view->genres[]     = '';                                                           // For choosing nothing
$view->directors[]  = '';                                                           // For choosing nothing
$view->prices       = ['', 'A - £3.50', 'B - £2.50', 'C - £1.00'];
$view->selected     = setSelected();

$filmsTable     = new \dvds4u\FilmsTable();
$genresTable    = new \dvds4u\GenresTable();
$directorsTable = new \dvds4u\DirectorsTable();

$films      = $filmsTable->fetchAllEntities();
$genres     = $genresTable->fetchAllEntities();
$directors  = $directorsTable->fetchAllEntities();

if(filterIsSet()) {                                                                 // Any filter set?
    foreach($_POST as $key => $value) {
        if($key !== 'clear') {                                                      // Ignore clear
            if($key === 'price') {
                $priceFilter = setPriceFilter($value);
                if($priceFilter) {
                    $filters['price'] = $priceFilter;
                }
            } else {
                $filters[$key] = $value;
            }
            $view->selected[$key] = $value;
        }
    }
    if(isset($filters)) {
        // Make sure the table has a title to query even if empty
        ensureTitleExists($filters);
        $films = $filmsTable->fetchFilteredFilms($filters);
    }
}

$filmIds            = getFilmIds($films);
$view->years        = getViewYears($films);
$view->genres       = getViewGenres($filmIds, $genresTable);
$view->directors    = getDirectors($films, $directorsTable);
$view->films        = getFilmArray($films);                                         // Do this last in case of filters

if(isset($_POST['add'])) {
    // Must fill this as array_search returns index (0) on success
    $_SESSION['basket'][0]  = false;
    $added                  = $_POST['film_id'];
    $basket                 = &$_SESSION['basket'];                                 // Set a *reference* to session
    $alreadyInBasket        = array_search($added, $basket);
    if($alreadyInBasket) {
        $view->error = 'Already in basket';
    } else {
        $basket[]       = $added;
        $view->success  = 'Added to basket';
    }
}
if(isset($_POST['clear'])) {
    foreach($view->selected as $key => $value) {
        $view->selected[$key] = '';
    }
    unset($_POST);
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $_SERVER['PHP_SELF'] . '">';
}

require_once 'views/dvds.php';

// Creates an empty array for filters with each category
function setSelected()
{
    return [
        'title'     => '',
        'genre'     => '',
        'director'  => '',
        'actor'     => '',
        'year_from' => '',
        'year_to'   => '',
        'price'     => '',
    ];
}

// Converts price value strings to price bracket values for database query
function setPriceFilter($value)
{
    $filter = false;
    if($value === 'A - £3.50') {
        $filter = 1;
    } else if($value === 'B - £2.50') {
        $filter = 2;
    } else if($value === 'C - £1.00') {
        $filter = 3;
    }
    return $filter;
}

// Ensure title is set for database query which requires at least this field
function ensureTitleExists($filters)
{
    if(!array_key_exists('title', $filters)) {
        $filters['title'] = '';
    }
}

// Get all the (filtered) years of release in an array to be used for filter dropdown
function getViewYears($films)
{
    $years[] = '';
    foreach($films as $film) {
        $years[] = $film->__get('year_of_release');
    }
    $years = array_unique($years);
    sort($years);
    return $years;
}

// Get all the (filtered) genre IDs in an array to be used for filter dropdown
function getViewGenres($filmIds, $genresTable)
{
    $hasGenreTable  = new \dvds4u\HasGenreTable();
    $genreIds       = $hasGenreTable->fetchGenreIdsByFilmIds($filmIds);
    $genres         = $genresTable->fetchGenres($genreIds);
    $genres         = array_unique($genres);
    sort($genres);
    array_unshift($genres, '');
    return $genres;
}

// Get all the (filtered) director IDs in an array to be used for filter dropdown
function getDirectors($films, $directorsTable)
{
    $directors[] = '';
    foreach($films as $film) {
        $directorId     = $film->__get('director_id');
        $directors[]    = $directorsTable->fetchName($directorId);
    }
    $directors = array_unique($directors);
    sort($directors);
    return $directors;
}

// Get all the (filtered) film IDs in a delimited string to be used for queries
function getFilmIds($films)
{
    $filmIds = '';
    foreach($films as $film) {
        $filmIds .= ', ' . $film->__get('id');
    }
    return substr($filmIds, 2);
}

// Return an array of film attributes for each (filtered) film to be used by the view
function getFilmArray($films)
{
    $arrFilms = [];
    foreach($films as $film) {
        $arrFilms[] = [
            'id'        => $film->__get('id'),
            'title'     => $film->__get('title'),
            'rentable'  => isRentable($film),                                  // Logged in and no client_id
            'url'       => 'dvd.php?film_id=' . $film->__get('id'),
            'image'     => base64_encode($film->__get('image')),
//            'imageName' => $film->__get('image_name'),
        ];
    }
    return $arrFilms;
}

// Check all post values for filters to see if any are set
function filterIsSet()
{
    return isset($_POST['title'])
        || isset($_POST['genre'])
        || isset($_POST['director'])
        || isset($_POST['actor'])
        || isset($_POST['year_from'])
        || isset($_POST['year_to'])
        || isset($_POST['price']);
}