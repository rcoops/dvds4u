<?php

namespace dvds4u;

class ClientsTable extends TableAbstract
{

    protected $name = 'users';
    protected $primaryKey = 'user_id';

    public function getByEmail($email)
    {
        $sql = 'SELECT * FROM ' . $this->name . ' WHERE ' . $email . ' = :email LIMIT 1';
        $results = $this->dbh->prepare($sql);
        $results->execute([':email' => $email]);
        return $results->fetch();

    }
}