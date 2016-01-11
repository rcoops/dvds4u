<?php

namespace dvds4u;

// Abstract table with common functions usable by any table
class TableAbstract
{
    protected $primaryKey = 'id', $dbh, $db, $tableName;

    // Constructs a new table object with a PDO handler
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->dbh = $this->db->getDbh();
    }

    // Fetches all rows from the table
    protected function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $results = $this->dbh->prepare($sql);
        $results->execute();
        return $results;
    }

    // Fetches all rows from a table and returns them as entities
    public function fetchAllEntities()
    {
        $results = $this->fetchAll();
        $entities = [];
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {
            $entities[] = new Entity($row);
        }
        return $entities;
    }

    // Fetches an entity specified by its primary key
    public function fetchByPrimaryKey($key)
    {
        $sql = "SELECT * FROM $this->tableName"
            . " WHERE $this->primaryKey = :id LIMIT 1";
        $results = $this->dbh->prepare($sql);
        $results->execute([':id' => $key]);
        return new Entity($results->fetch(\PDO::FETCH_ASSOC));
    }

    // Updates an attribute of a row specified by its primary key with a new value
    public function updateField($primaryKey, $attribute, $value)
    {
        $sql = "UPDATE $this->tableName SET $attribute = :value"
            . " WHERE $this->primaryKey =:primaryKey";
        $result = $this->dbh->prepare($sql);
        $result->execute([':value' => $value, ':primaryKey' => $primaryKey]);
    }

    // Removes a row from the table specified by its primary key
    public function removeEntity($id) {
        $sql = "DELETE FROM $this->tableName"
            . " WHERE $this->primaryKey = :id";
        $result = $this->dbh->prepare($sql);
        $result->execute([':id' => $id]);
    }

}