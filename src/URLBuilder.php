<?php namespace KBussche\Dweet;

use Carbon\Carbon;

class URLBuilder
{
    const DWEET_BASE_URL = 'https://dweet.io/';
    const DWEET_WRITE = 'dweet/for';
    const DWEET_READ = 'get/dweets/for';
    const DWEET_LATEST = 'get/latest/dweet/for';

    private $url;
    private $thing;
    private $date;

    public function __construct()
    {
        $this->init();
    }

    public function write()
    {
        $this->url .= self::DWEET_WRITE;
        return $this;
    }

    public function read()
    {
        $this->url .= self::DWEET_READ;
        return $this;
    }

    public function readAll()
    {
        $this->url .= self::DWEET_LATEST;
        return $this;
    }

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function payload(array $payload)
    {
        $this->payload = $payload;
        return $this;
    }

    public function build()
    {
        $url = $this->url . '/' . $this->name; 
        
        if (!empty($this->payload)) {
            $url .= '?' . http_build_query($this->payload);
        }

        $this->init();

        return $url;
    }

    private function init()
    {
        $this->url = self::DWEET_BASE_URL;
        $this->name = null;
        $this->payload = null;
        $this->date = new Carbon();
    }

}
