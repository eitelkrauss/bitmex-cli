<?php

namespace App\ApiKeys;

class ReadKeys {

    public function __construct($json_url)
    {
        $keys = json_decode(file_get_contents($json_url));
        $this->id = $keys->id;
        $this->secret = $keys->secret;
    }

}