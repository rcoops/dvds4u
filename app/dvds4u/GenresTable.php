<?php

namespace dvds4u;

// Models our genres table in the database
class GenresTable extends TableAbstract
{

    // Populate table name
    protected $tableName = 'genres';

    // Table attributes
    protected $genre = 'genre';

    // Returns a the primary key of a genre
    public function fetchIdByGenre($genre)
    {
        $sql = "SELECT $this->primaryKey FROM $this->tableName"
            . " WHERE $this->genre=:genre";
        $results = $this->dbh->prepare($sql);
        $results->execute([':genre' => $genre]);
        $row = $results->fetch(\PDO::FETCH_ASSOC);
        return $row[$this->primaryKey];
    }

    // Fetch all genres within the set of primary keys
    public function fetchGenres($ids)
    {
        $sql = "SELECT $this->genre FROM $this->tableName"
            . " WHERE $this->primaryKey IN ($ids)";
        $results = $this->dbh->prepare($sql);
        $results->execute();
        $genres = [];
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {
            $genres[] = $row[$this->genre];
        }
        return $genres;
    }

}