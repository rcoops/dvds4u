<?php

namespace dvds4u;

class GenresTable extends TableAbstract
{

    protected $tableName = 'genres';

    // Table attributes
    protected $genre = 'genre';

    public function fetchIdByGenre($genre)
    {
        $sql = "SELECT $this->primaryKey FROM $this->tableName WHERE $this->genre=:genre";
        $results = $this->dbh->prepare($sql);
        $results->execute([':genre' => $genre]);
        $arrResults = $results->fetch(\PDO::FETCH_ASSOC);

        return $arrResults[$this->primaryKey];
    }
}