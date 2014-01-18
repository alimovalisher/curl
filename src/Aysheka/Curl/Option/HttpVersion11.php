<?php

namespace Aysheka\Curl\Option;

class HttpVersion11 implements Option
{
    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_HTTP_VERSION, $this->getVersion());
    }

    protected function getVersion()
    {
        return CURL_HTTP_VERSION_1_1;
    }

}
