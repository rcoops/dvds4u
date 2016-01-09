<?php

namespace dvds4u;

// Models our films table in the database
class FilmsTable extends TableAbstract
{

    // Populate table name
    protected $tableName = 'films';

    // Table attributes
    protected $id = 'id';
    protected $title = 'title';
    protected $yearOfRelease = 'year_of_release';
    protected $priceBand = 'price_band';
    protected $synopsis = 'synopsis';
    protected $directorId = 'director_id';
    protected $clientId = 'client_id';
    protected $image = 'image';

    // Returns a set of film entities selected by a set of filters
    public function fetchFilteredFilms($filters)
    {
        $results = $this->fetchByFilters($filters);
        $entities = [];
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {                      // Only want assoc array
            $entities[] = new Entity($row);
        }
        return $entities;
    }

    // Returns all rows selected by a set of filters
    private function fetchByFilters($filters)
    {
        $sql = "SELECT * FROM $this->tableName"                                 // Can use partial/empty title
            . " WHERE $this->title LIKE :title";
        foreach($filters as $attribute => $value) {                             // Associative attribute and value
            if($value) {
                switch($attribute) {
                    case 'genre':
                        $genresTable = new GenresTable();
                        $hasGenreTable = new HasGenreTable();
                        $id = $genresTable->fetchIdByGenre($value);
                        $films = $hasGenreTable->fetchFilmIdsByGenreId($id);
                        $sql .=  " AND $this->primaryKey IN($films)";
                        break;
                    case 'director':
                        $directorsTable = new DirectorsTable();
                        $arrValue = explode(', ', $value);
                        $directorId = $directorsTable->fetchIdByName($arrValue[0], $arrValue[1]);
                        $sql .= " AND $this->directorId=$directorId";
                        break;
                    case 'actor':
                        $actorsTable = new ActorsTable();
                        $starsActorTable = new StarsActorTable();
                        $ids = $actorsTable->fetchIdsBySurname($value);
                        $films = $starsActorTable->fetchFilmIds($ids);
                        $sql .=  " AND $this->primaryKey IN($films)";
                        break;
                    case 'year_from':
                        $sql .= " AND $this->yearOfRelease >= $value";
                        break;
                    case 'year_to':
                        $sql .= " AND $this->yearOfRelease <= $value";
                        break;
                    case 'price':
                        $sql .= " AND $this->priceBand = $value";
                        break;
                    // Do nothing if we don't recognise the key
                    default:
                }
            }
        }
        $results = $this->dbh->prepare($sql);
        $results->execute([':title' => '%' . $filters[$this->title] . '%']);
        return $results;
    }

    public function fetchFilmsRented($id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE $this->clientId = :id";
        $results = $this->dbh->prepare($sql);
        $results->execute([':id' => $id]);
        $entities = [];
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {                      // Only want assoc array
            $entities[] = new Entity($row);
        }
        return $entities;
    }

}