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
    protected $imageName = 'image_name';

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

    // Returns an array of film entities that are rented by a specific user
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

    // Returns all rows selected by a set of filters
    private function fetchByFilters($filters)
    {
        $sql = "SELECT * FROM $this->tableName"                                 // Can use partial/empty title
            . " WHERE $this->title LIKE :title";
        foreach($filters as $attribute => $value) {                             // Associative attribute and value
            if($value) {                                                        // Ignore false/null/empty filters
                switch($attribute) {
                    case 'genre':
                        $sql .= $this->addGenreSQL($value);
                        break;
                    case 'director':
                        $sql .= $this->addDirectorSQL($value);
                        break;
                    case 'actor':
                        $sql .= $this->addActorSQL($value);
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
                    default:                                                    // Do nothing if key not recognised
                        break;
                }
            }
        }
        $results = $this->dbh->prepare($sql);
        $results->execute([':title' => '%' . $filters[$this->title] . '%']);
        return $results;
    }

    private function addGenreSQL($value)
    {
        $genresTable = new GenresTable();
        $hasGenreTable = new HasGenreTable();
        $genreId = $genresTable->fetchIdByGenre($value);
        $filmsIds = $hasGenreTable->fetchFilmIdsByGenreId($genreId);
        return " AND $this->primaryKey IN($filmsIds)";
    }

    private function addDirectorSQL($value)
    {
        $directorsTable = new DirectorsTable();
        $arName = explode(', ', $value);                                        // Given value straight from combobox
        $directorId = $directorsTable->fetchIdByName($arName[0], $arName[1]);   // Surname then firstname
        return " AND $this->directorId=$directorId";
    }

    private function addActorSQL($value)
    {
        $actorsTable = new ActorsTable();
        $starsActorTable = new StarsActorTable();
        $ids = $actorsTable->fetchIdsBySurname($value);
        $films = $starsActorTable->fetchFilmIds($ids);
        return " AND $this->primaryKey IN($films)";
    }

}