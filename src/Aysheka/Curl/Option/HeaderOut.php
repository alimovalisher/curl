<?php

namespace Aysheka\Curl\Option;

class HeaderOut implements Option
{
    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLINFO_HEADER_OUT, true);
    }
}
