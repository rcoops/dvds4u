<?php

/**
 * Created by PhpStorm.
 * User: rick
 * Date: 24/11/15
 * Time: 09:40
 */
class Client
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