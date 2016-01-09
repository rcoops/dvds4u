<?php

namespace dvds4u;

class Entity
{

    protected $data = array();

    // Constructs the entity from a fetched database row
    public function __construct($dbrow)
    {
        foreach($dbrow as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    // Magic method for returning the value given a specified key
    public function __get($key)
    {
        if(array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }

    }

}