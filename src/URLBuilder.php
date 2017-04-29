<?php namespace KBussche\Dweet;

use Carbon\Carbon;

class URLBuilder
{
    const DWEET_BASE_URL = 'https://dweet.io/';
    const DWEET_WRITE = 'dweet/for';
    const DWEET_READ = 'get';

    private $url;
    private $thing;
    private $date;

    public function __construct()
    {
        $this->url = self::DWEET_BASE_URL;
        $this->date = new Carbon();
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
        return $this->url . '/' . $this->name . '?' . http_build_query($this->payload);
    }

}
