<?php namespace KBussche\Dweet;

use GuzzleHttp\Client;

class Service
{
    private $default_name;
    private $client;

    public function __construct(URLBuilder $builder, Client $client, $default_name)
    {
        $this->builder = $builder;
        $this->default_name = $default_name;
    }

    public function set(array $data)
    {
        $this->setWithName($this->default_name, $data);
    }

    public function setWithName($name, array $data)
    {

    }

    public function get($name = null)
    {
        $key_name = is_null($name) ? $this->name : $name;
    }

}

