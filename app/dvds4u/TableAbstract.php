<?php

namespace dvds4u;

class TableAbstract
{
    protected $name;
    protected $primaryKey = 'id', $dbh, $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->dbh = $this->db->getDbh();
    }

    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->name;
        $results = $this->dbh->prepare($sql);
        $results->execute();

        $entities = $this->getEntitiesAsArray($results);

        return $entities;
    }

    public function fetchByPrimaryKey($key)
    {
        $sql = 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $results = $this->dbh->prepare($sql);
        $results->execute([':id' => $key]);
        return $results->fetch();
    }

    protected function getEntitiesAsArray($results) {

        $entities = array();
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    protected function getEntity($results)
    {
        return new Entity($results->fetch(\PDO::FETCH_ASSOC));
    }
}