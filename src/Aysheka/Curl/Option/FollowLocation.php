<?php

namespace Aysheka\Curl\Option;

class FollowLocation implements Option
{
    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_FOLLOWLOCATION, true);
    }
}
