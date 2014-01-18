<?php
namespace Aysheka\Curl\Option;

class HeaderInResponse implements Option
{
    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_HEADER, true);
    }

}
