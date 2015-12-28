<?php

namespace dvds4u;

class StarsActorTable extends TableAbstract
{

    protected $tableName = 'stars_actor';

    // Table attributes
    protected $filmId = 'film_id';
    protected $actorId = 'actor_id';

    public function fetchActorIds($filmId)
    {
        $sql = "SELECT $this->actorId FROM $this->tableName WHERE $this->filmId=:film_id";
        $results = $this->dbh->prepare($sql);
        $results->execute([':film_id' => $filmId]);
        while($row = $results->fetch(\PDO::FETCH_NUM)) {
            $actors[] = $row[0];
        }
        return $actors;
    }

    public function fetchFilmIds($actorIds)
    {
        $sql = "SELECT $this->filmId FROM $this->tableName WHERE $this->actorId IN ($actorIds)";
        $results = $this->dbh->prepare($sql);
        $results->execute();
        $ids = '';
        while($row = $results->fetch(\PDO::FETCH_NUM)) {
            $ids .= ', ' . $row[0];
        }
        return substr($ids, 2);                                                 // Chop off the first ', '
    }

}