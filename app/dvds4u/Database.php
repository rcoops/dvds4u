<?php

namespace dvds4u;

class Database {

    protected static $instance = null;
    protected $dbh;

    public static function getInstance() {
        $username = 'stb098'; // connection info for helios.csesalford.com
        $password = '*stb098*'; // change this to the password provided
        $host = 'helios.csesalford.com';
        $dbname = 'stb098_dvds4u';

        if (self::$instance === null) { //checks if the object exists
            // creates new instance if not, sending in connection info
            self::$instance = new self($username, $password, $host, $dbname);
        }

        return self::$instance;
    }

    private function __construct($username, $password, $host, $database) {
        try {
            $this->dbh = new \PDO("mysql:host=$host;dbname=$database", $username, $password); // creates the database handler with connection info
        } catch (\PDOException $e) {
            echo 'Sorry, the database has disappeared!' . '</br>' . $e->getMessage();
        }
    }

    public function getDbh() {
        return $this->dbh; // returns the database handler to be used elsewhere
    }

    public function __destruct() {
        $this->dbh = null; // destroys the database handler when no longer needed
    }

}