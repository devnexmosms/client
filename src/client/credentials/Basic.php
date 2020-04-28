<?php

namespace Nexmosms\Client\Credentials;

class Basic
{
    public $apikey;
    public $apisecret;

    public function __construct($apikey, $apisecret) {
        $this->apisecret = $apisecret;
        $this->apikey = $apikey;
    }
}

?>