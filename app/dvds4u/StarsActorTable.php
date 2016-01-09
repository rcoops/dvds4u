<?php

namespace dvds4u;

// Models our stars_actor table in the database
class StarsActorTable extends TableAbstract
{

    // Populate table name
    protected $tableName = 'stars_actor';

    // Table attributes
    protected $filmId = 'film_id';
    protected $actorId = 'actor_id';

    // Returns all actor ids associated with a specific film id
    public function fetchActorIds($filmId)
    {
        $sql = "SELECT $this->actorId FROM $this->tableName"
            . " WHERE $this->filmId=:film_id";
        $results = $this->dbh->prepare($sql);
        $results->execute([':film_id' => $filmId]);
        $actorIds = [];
        while($row = $results->fetch(\PDO::FETCH_NUM)) {
            $actorIds[] = $row[0];
        }
        return $actorIds;
    }

    // Returns all film ids associated with a specific actor id
    public function fetchFilmIds($actorIds)
    {
        $sql = "SELECT $this->filmId FROM $this->tableName"
            . " WHERE $this->actorId IN ($actorIds)";
        $results = $this->dbh->prepare($sql);
        $results->execute();
        $ids = '';
        while($row = $results->fetch(\PDO::FETCH_NUM)) {
            $ids .= ', ' . $row[0];
        }
        return substr($ids, 2);                                                 // Chop off the first ', '
    }

}