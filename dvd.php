<?php

require_once 'app/init.php';

$filmsTable = new \dvds4u\FilmsTable();
// Assign to session to prevent page refresh from removing id
if(isset($_GET['film_id'])) {
    $_SESSION['film_id']    = $_GET['film_id'];
    $film                   = $filmsTable->fetchByPrimaryKey($_GET['film_id']);
} else {
    $film = $filmsTable->fetchByPrimaryKey($_SESSION['film_id']);
}

$view->pageTitle = $film->__get('title');

$view->year         = $film->__get('year_of_release');
$view->price        = getStrPrice($film);
$view->pK           = $film->__get('id');
$view->image        = base64_encode($film->__get('image'));
//$view->imageName    = $film->__get('image_name');
$view->genre        = getGenres($film);
$view->synopsis     = $film->__get('synopsis');
$view->director     = getDirector($film);
$view->rentable     = isRentable($film);
$view->cast         = getCast($film);                               // Chop off the first ', '

require_once 'views/dvd.php';

function getGenres($film)
{
    $hasGenreTable  = new \dvds4u\HasGenreTable();
    $genresTable    = new \dvds4u\GenresTable();
    $filmPK         = $film->__get('id');                           // Get film id
    $genresOfFilm   = $hasGenreTable->fetchGenreIdsByFilmIds($filmPK);
    $genres         = $genresTable->fetchGenres($genresOfFilm);
    $strGenres      = '';
    foreach($genres as $genre) {
        $strGenres .= '/' . $genre;
    }
    return substr($strGenres, 1);
}

function getCast($film)
{
    $hasActorsTable = new \dvds4u\StarsActorTable();
    $actorsTable    = new \dvds4u\ActorsTable();
    $filmPK         = $film->__get('id');                           // Get film id
    $actorsInFilm   = $hasActorsTable->fetchActorIds($filmPK);      // Get actor ids linked to film id
    $actors         = $actorsTable->fetchNames($actorsInFilm);      // Get actor names linked to actor ids
    $strActors      = '';
    foreach($actors as $actor) {
        $strActors .= ', ' . $actor;                                // Stick them in a comma separated string
    }
    return substr($strActors, 2);
}

function getDirector($film)
{
    $directorsTable = new \dvds4u\DirectorsTable();
    $director       = $film->__get('director_id');
    return $directorsTable->fetchName($director);
}