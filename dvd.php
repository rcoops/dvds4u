<?php
require_once 'app/init.php';
$filmsTable = new \dvds4u\FilmsTable();
$hasActorsTable = new \dvds4u\StarsActorTable();
$actorsTable = new \dvds4u\ActorsTable();
$directorsTable = new \dvds4u\DirectorsTable();

$film = $filmsTable->fetchByPrimaryKey($_GET['fid']);

$view->pageTitle = $film->__get('title');
$view->year = $film->__get('year_of_release');
$price = $film->__get('price_band');
switch($price) {
    case 1:
        $view->price = '£3.50';
        break;
    case 2:
        $view->price = '£2.50';
        break;
    default:                                                // Set as default to ensure a price is set
        $view->price = '£1.00';
        break;
}
$view->picture = $film->__get('picture');
$view->synopsis = $film->__get('synopsis');
$view->director = $directorsTable->fetchName($film->__get('director_id'));
$view->rentable = (isset($_SESSION['user_id']) && !$film->__get('client_id'));
// Sub-query: fetch all names from actors where id=(fetch all ids from has_actors where film id = id)
$view->actors = $actorsTable->fetchNames($hasActorsTable->fetchActorIds($film->__get('id')));
$view->totalCast = count($view->actors) - 1;                // Set to -1 as last actor gets added to view without ','
$view->id = $film->__get('id');

require_once 'views/dvd.php';