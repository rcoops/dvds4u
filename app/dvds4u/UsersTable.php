<?php

namespace dvds4u;

class UsersTable extends TableAbstract
{

    protected $tableName = 'users';

    // Table attributes
    protected $email = 'email';
    protected $firstName = 'first_name';
    protected $pass = 'pass';
    protected $address = 'address';
    protected $city = 'city';
    protected $postcode = 'postcode';
    protected $phone = 'phone_number';
    protected $active = 'active';
    protected $hash = 'hash';

    public function fetchByEmail($email)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $this->email . ' = :email';
        $result = $this->dbh->prepare($sql);
        $result->execute([':email' => $email]);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $entity = null;                                             // also false
        if($row) {
            $entity = new Entity($row);
        }
        return $entity;
    }

    public function addUser($details)
    {
        $sql = "INSERT INTO " . $this->tableName
            . " ($this->email,
                 $this->firstName,
                 $this->pass,
                 $this->address,
                 $this->city,
                 $this->postcode,
                 $this->phone,
                 $this->hash)"
            . " VALUES ( :email, :first_name, :pass, :address, :city, :postcode, :phone, :hashVal)";
        $result = $this->dbh->prepare($sql);
        $params = [
            ':email' => $details['email'],
            ':first_name' => $details['firstName'],
            ':pass' => password_hash($details['pass'], PASSWORD_BCRYPT),
            ':address' => $details['address'],
            ':city' => $details['city'],
            ':postcode' => $details['postcode'],
            ':phone' => $details['phoneNumber'],
            ':hashVal' => md5(rand(0, 1000)), // doesn't matter what this is
        ];
        $result->execute($params);
    }

    public function activateAccount($email)
    {
        $sql = "UPDATE " . $this->tableName . " SET " . $this->active . "= 1"
        . " WHERE " . $this->email . "=:email";
        $result = $this->dbh->prepare($sql);
        $result->execute([':email' => $email]);
    }

    public function updateProfile($array)
    {
        $id = $array['id'];
        unset($array['id']);
        foreach($array as $key => $value) {
            $this->updateField($id, $key, $value);
        }
    }

    public function updatePassword($id, $pass)
    {
        $sql = "UPDATE " . $this->tableName . " SET " . $this->pass . "=:pass"
            . " WHERE " . $this->primaryKey . "=:primary_key";
        $result = $this->dbh->prepare($sql);
        $result->execute([':pass' => password_hash($pass, PASSWORD_BCRYPT), ':primary_key' => $id]);
    }

}