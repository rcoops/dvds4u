<?php

require_once 'app/init.php';

$view->pageTitle = 'Manage Users';

$usersTable = new \dvds4u\UsersTable();

if(isset($_POST['update'])) {
    $admin  = 0;
    $active = 0;
    $id     = $_POST['id'];
    if(isset($_POST['admin'])) {
        $admin = 1;
    }
    if(isset($_POST['active'])) {
        $active = 1;
    }
    $usersTable->updateField($id, 'active', $active);
    $usersTable->updateField($id, 'admin', $admin);
    $view->success = 'User updated';
} else if(isset($_POST['delete'])) {
    $filmsTable = new \dvds4u\FilmsTable();
    $rented     = $filmsTable->fetchFilmsRented($_POST['id']);
    if(empty($rented)) {
        $usersTable->removeEntity($_POST['id']);
        $view->success = 'The user has been removed';
    } else {
        $view->error = 'Cannot remove user - DVDs still in posession.';
    }

}
$users          = $usersTable->fetchAllEntities();
$view->users    = [];
foreach($users as $user) {
    $view->users[] = [
        'id'        => $user->__get('id'),
        'email'     => $user->__get('email'),
        'active'    => $user->__get('active'),
        'admin'     => $user->__get('admin'),
    ];
}

require_once 'views/manage_users.php';