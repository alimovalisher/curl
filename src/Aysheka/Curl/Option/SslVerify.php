<?php

namespace Aysheka\Curl\Option;

class SslVerify implements Option
{

    private $active;

    function __construct($active = true)
    {
        $this->active = $active;
    }

    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, $this->active);
    }

}
