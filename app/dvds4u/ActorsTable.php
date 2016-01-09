<?php

namespace dvds4u;

// Models our actors table in the database
class ActorsTable extends TableAbstract
{

    // Populate table name
    protected $tableName = 'actors';

    // Table attributes
    protected $firstName = 'first_name';
    protected $surname = 'surname';

    // Returns a string of comma separated ids for use by has_actors to return associated film ids
    public function fetchIdsBySurname($surname)
    {
        $sql = "SELECT $this->primaryKey FROM $this->tableName"
            . " WHERE $this->surname LIKE :surname";
        $results = $this->dbh->prepare($sql);
        $results->execute([':surname' => '%' . $surname . '%']);
        $ids = '';
        while($row = $results->fetch(\PDO::FETCH_NUM)) {
            $ids .= ', ' . $row[0];
        }
        $ids = substr($ids, 2);                                                 // Chop off the first ', '
        return $ids;
    }

    // Returns an array of names associated with an array of actor ids
    public function fetchNames($ids)
    {
        $names = [];
        foreach($ids as $id) {
            $names[] = $this->fetchName($id);
        }
        return $names;
    }

    // Returns a specific actor's name associated with an id
    private function fetchName($id)
    {
        $sql = "SELECT $this->firstName, $this->surname FROM $this->tableName "
            . "WHERE $this->primaryKey=:id";
        $results = $this->dbh->prepare($sql);
        $results->execute([':id' => $id]);
        $arrResults = $results->fetch(\PDO::FETCH_ASSOC);
        return $arrResults[$this->firstName] . ' ' . $arrResults[$this->surname];
    }

}