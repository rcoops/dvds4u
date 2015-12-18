<?php

namespace dvds4u;

class UsersTable extends TableAbstract
{

    protected $name = 'users';
    protected $primaryKey = 'user_id';
    protected $email = 'email';

    public function fetchAllUsers()
    {
        $results = $this->fetchAll();
        $users = [];
        while($row = $results->fetch()) {
            $users[] = new Entity($row);
        }
    }

    public function fetchByEmail($email)
    {
        $sql = 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->email . ' = :email LIMIT 1';
        $result = $this->dbh->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();
        //$result->execute([':email' => $email]);
        $row = $result->fetch();
        $entity = null; // also false
        if($row) {
            $entity = new Entity($row);
        }
        return $entity;
    }

}