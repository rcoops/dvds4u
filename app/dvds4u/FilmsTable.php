<?php

namespace dvds4u;

class FilmsTable extends TableAbstract
{

    protected $tableName = 'films';

    // Table attributes
    protected $id = 'id';
    protected $title = 'title';
    protected $yearOfRelease = 'year_of_release';
    protected $priceBand = 'price_band';
    protected $picture = 'picture';
    protected $synopsis = 'synopsis';
    protected $directorId = 'director_id';
    protected $clientId = 'client_id';

    protected function fetchByFilters($filters)
    {
        $sql = "SELECT * FROM $this->tableName WHERE $this->title LIKE :title"; // Can always include a partial title
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
                        $id = $actorsTable->fetchIdsBySurname($value);
                        $films = $starsActorTable->fetchFilmIds($id);
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
                }
            }
        }
        $results = $this->dbh->prepare($sql);
        $results->execute([':title' => '%' . $filters['title'] . '%']);
        return $results;
    }

    public function fetchFilteredFilms($filters)
    {
        $results = $this->fetchByFilters($filters);
        $entities = [];
        while($row = $results->fetch(\PDO::FETCH_ASSOC)) {                      // Only want assoc array
            $entities[] = new Entity($row);
        }
        return $entities;
    }

    public function getClientField()
    {
        return $this->clientId;
    }
}