<?php
namespace Aysheka\Curl\Option;

class HttpParameters implements Option
{
    private $parameters = [];

    function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $this->parameters);
    }

}
