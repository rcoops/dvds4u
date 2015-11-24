<?php

/**
 * Created by PhpStorm.
 * User: rick
 * Date: 24/11/15
 * Time: 10:03
 */

require_once 'Client.php';
require_once 'TableAbstract.php';

class ClientsTable extends TableAbstract
{

    protected $name = 'clients';
    protected $primaryKey = 'id';

    public function fetchAllClients()
    {
        $results = $this->fetchAll();
        $clientArray = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)) {
            $clientArray[] = new Client($row);
        }

        return $clientArray;
    }

}