<?php

define("ROOT", __DIR__ . '/');
define("HTTP", $_SERVER['HTTP_HOST'] . '/DvdRental/');

require_once 'app/init.php';

$view = new stdClass();
$view->pageTitle = 'DVDs 4 U';

require 'views/index.php';
?>
<table class="table">
    <th>Name</th><th>Email</th>
    <tbody>
<?php foreach($allClientInfo as $client): ?>
    <tr>
        <td><?= $client->__get('first_name'); ?></td>
        <td><?= $client->__get('email'); ?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>