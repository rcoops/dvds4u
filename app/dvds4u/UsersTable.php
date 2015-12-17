<?php

namespace dvds4u;

class UsersTable extends TableAbstract
{

    protected $name = 'users';
    protected $primaryKey = 'user_id';
    protected $email = 'email';

    public function fetchByEmail($email)
    {
        $sql = 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->email . ' = :email LIMIT 1';
        $result = $this->dbh->prepare($sql);
        $result->execute([':email' => $email]);

        return $this->getEntity($result);
    }

}