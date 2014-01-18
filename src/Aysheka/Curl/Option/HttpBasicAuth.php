<?php

namespace Aysheka\Curl\Option;

class HttpBasicAuth implements Option
{
    private $username;
    private $password;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curlHandler, CURLOPT_USERPWD, sprintf('%s:%s', $this->username, $this->password));
    }

}
