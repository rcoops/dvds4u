<?php

namespace dvds4u;

class Entity
{

    protected $data = array();

    public function __construct($dbrow)
    {
        foreach($dbrow as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }

    }

}