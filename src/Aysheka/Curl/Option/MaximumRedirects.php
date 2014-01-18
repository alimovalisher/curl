<?php

namespace Aysheka\Curl\Option;


class MaximumRedirects implements Option
{
    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_MAXREDIRS, 25);
    }

}
