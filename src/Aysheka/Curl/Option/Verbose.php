<?php

namespace Aysheka\Curl\Option;

class Verbose implements Option
{
    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_VERBOSE, true);
    }

}
