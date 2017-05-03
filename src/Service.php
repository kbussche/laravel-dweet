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

        $result = $this->fetch($url);

        if ($result) {
            return Dweet::fromResponse($result);
        }

        return Dweet::empty(); 
    }

    /* Break these two methods into their own http abstration */
    private function fetch($url)
    {
        $options = [
            'timeout' => 6
        ];

        try {
            $response = $this->client->request('GET', $url, $options);
        } catch (Exception $e) {
            \Log::info('Dweet is not reachable: try later', [$e->getMessage()]);
            return false;
        }

        if ($response->getReasonPhrase() != 'OK') {
            return false;
        }

        return $response->getBody();
    }

    private function send($url)
    {
        $options = [
            'timeout' => 6
        ];

        try {
            $response = $this->client->request('GET', $url, $options);
        } catch (Exception $e) {
            \Log::info('Dweet is not reachable: try later', [$e->getMessage()]);
            return false;
        }

        if ($response->getReasonPhrase() === 'OK') {
            return true;
        }

        return false;
    }
}

