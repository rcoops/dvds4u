<?php

namespace dvds4u;

class HasGenreTable extends TableAbstract
{

    protected $tableName = 'has_genre';

    // Table attributes
    protected $filmId = 'film_id';
    protected $genreId = 'genre_id';

    public function fetchFilmIdsByGenreId($genreId)
    {
        $sql = "SELECT $this->filmId FROM $this->tableName WHERE $this->genreId=:genre_id";
        $results = $this->dbh->prepare($sql);
        $results->execute([':genre_id' => $genreId]);
        $arrResults = $results->fetch(\PDO::FETCH_ASSOC);
        $strResult = $arrResults[$this->filmId];
        while($row = $results->fetch(\PDO::FETCH_NUM)) {
            $arrResults = $row;                                                             // Overwrite each fetch and...
            $strResult .= ', ' . $arrResults[0];                                            // add the index to the string
        }
        return $strResult;
    }

}