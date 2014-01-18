<?php

namespace Aysheka\Curl\Option;

class Url implements Option
{
    private $url;

    function __construct($url)
    {
        $this->url = $url;

    }

    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_URL, $this->getUrl());
    }

    protected function getUrl()
    {
        return $this->url;
    }

}
