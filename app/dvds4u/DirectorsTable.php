<?php

namespace dvds4u;

class DirectorsTable extends TableAbstract
{

    protected $tableName = 'directors';

    // Table attributes
    protected $firstName = 'first_name';
    protected $surname = 'surname';

    public function fetchIdByName($surname, $firstName)
    {
        $sql = "SELECT $this->primaryKey FROM $this->tableName WHERE $this->firstName = :firstName AND $this->surname = :surname";
        $results = $this->dbh->prepare($sql);
        $results->execute([':firstName' => $firstName, ':surname' => $surname]);
        $arrResults = $results->fetch(\PDO::FETCH_ASSOC);
        return $arrResults[$this->primaryKey];
    }

    public function fetchName($id)
    {
        $sql = "SELECT $this->firstName, $this->surname FROM $this->tableName WHERE $this->primaryKey = :id";
        $results = $this->dbh->prepare($sql);
        $results->execute([':id' => $id]);
        $name = $results->fetch(\PDO::FETCH_ASSOC);
        return $name[$this->firstName] . ' ' . $name[$this->surname];
    }
}