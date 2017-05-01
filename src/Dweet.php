<?php namespace KBussche\Dweet;

class Dweet
{
    public $thing;
    public $created;
    public $content;

    public static function fromResponse($response_body)
    {   
        $result = [];

        $data = json_decode($response_body); 

        if (empty($data)) {
            return new Dweet(null, null, null);
        }

        foreach ($data->with as $message) {
            $result[] = new Dweet($message->thing, $message->created, $message->content);    
        }

        return $result;
    }

    public function __construct($thing, $created, $content)
    {
        $this->thing = $thing;
        $this->created = $created;
        $this->content = $content;
    }
}
