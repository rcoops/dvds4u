<?php

namespace dvds4u;

class ActorsTable extends TableAbstract
{

    protected $tableName = 'actors';

    // Table attributes
    protected $firstName = 'first_name';
    protected $surname = 'surname';

    public function fetchIdsBySurname($surname)
    {
        $sql = "SELECT $this->primaryKey FROM $this->tableName WHERE $this->surname LIKE :surname";
        $results = $this->dbh->prepare($sql);
        $results->execute([':surname' => '%' . $surname . '%']);
        $ids = '';
        while($row = $results->fetch(\PDO::FETCH_NUM)) {
            $ids .= ', ' . $row[0];
        }
        $ids = substr($ids, 2);                                                 // Chop off the first ', '
        return $ids;
    }

    protected function fetchName($id)
    {
        $sql = "SELECT $this->firstName, $this->surname FROM $this->tableName WHERE $this->primaryKey=:id";
        $results = $this->dbh->prepare($sql);
        $results->execute([':id' => $id]);
        $arrResults = $results->fetch(\PDO::FETCH_ASSOC);
        return $arrResults[$this->firstName] . ' ' . $arrResults[$this->surname];
    }

    public function fetchNames($ids)
    {
        $names = [];
        foreach($ids as $id) {
            $names[] = $this->fetchName($id);
        }

        return $names;
    }
}