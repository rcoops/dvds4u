<?php

namespace dvds4u;

// Models our has_genre table in the database
class HasGenreTable extends TableAbstract
{

    // Populate table name
    protected $tableName = 'has_genre';

    // Table attributes
    protected $filmId = 'film_id';
    protected $genreId = 'genre_id';

    // Returns all films that share a specific genre id as a comma separated string
    public function fetchFilmIdsByGenreId($genreId)
    {
        $sql = "SELECT $this->filmId FROM $this->tableName"
            . " WHERE $this->genreId=:genreId";
        $results = $this->dbh->prepare($sql);
        $results->execute([':genreId' => $genreId]);
        $ids = '';
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {
            $arrResults = $row;                                                     // Overwrite each fetch and...
            $ids .= ', ' . $arrResults[$this->filmId];                              // add the index to the string
        }
        return substr($ids, 2);                                                     // Chop off the first ', '
    }

    // Returns all genres shared by a limited set of films
    public function fetchGenreIdsByFilmIds($filmIds)
    {
        $sql = "SELECT DISTINCT  $this->genreId FROM $this->tableName"
            . " WHERE $this->filmId IN ($filmIds)";
        $results = $this->dbh->prepare($sql);
        $results->execute();
        $ids = '';
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {
            $ids .= ', ' . $row[$this->genreId];                                    // add the index to the string
        }
        return substr($ids, 2);                                                     // Chop off the first ', '
    }

}