<?php

namespace dvds4u;

class TableAbstract
{
    protected $primaryKey = 'id', $dbh, $db, $tableName;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->dbh = $this->db->getDbh();
    }

    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $results = $this->dbh->prepare($sql);
        $results->execute();

        return $results;
    }

    public function fetchAllEntities()
    {
        $results = $this->fetchAll();
        $entities = [];
        while($row = $results->fetch()) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    public function fetchByPrimaryKey($key)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $results = $this->dbh->prepare($sql);
        $results->execute([':id' => $key]);
        return new Entity($results->fetch(\PDO::FETCH_ASSOC));
    }

    public function getPrimaryKey()
    {
        return $this->tableName . '.' . $this->primaryKey;
    }

    public function updateField($primaryKey, $attribute, $value)
    {
        $sql = "UPDATE " . $this->tableName . " SET " . $attribute . "=:value"
            . " WHERE " . $this->primaryKey . "=:primary_key";
        $result = $this->dbh->prepare($sql);
        $result->execute([':value' => $value, ':primary_key' => $primaryKey]);
    }

}