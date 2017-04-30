<?php namespace KBussche\Dweet;

use GuzzleHttp\Client;

class Service
{
    private $default_name;
    private $client;

    public function __construct(URLBuilder $builder, Client $client, $default_name = 'xxx123test')
    {
        $this->builder = $builder;
        $this->client = $client;
        $this->default_name = $default_name;
    }

    public function set(array $data)
    {
        $this->setWithName($this->default_name, $data);
    }

    public function setWithName($name, array $data)
    {
        $url = $this->builder
                ->write()
                ->name($name)
                ->payload($data)
                ->build();

        return $this->send($url);
    }

    public function get($name = null)
    {
        $key_name = is_null($name) ? $this->default_name : $name;

        $url = $this->builder
            ->read()
            ->name($key_name)
            ->build();
        
        return Dweet::fromResponse($this->send($url));
    }

    private function send($url)
    {
        $options = [
            'timeout' => 6
        ];

        $response = $this->client->request('GET', $url, $options);
        
        if ($response->getReasonPhrase() === 'OK') {
            return true;
        }

        return false;
    }
}

