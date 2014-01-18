<?php

namespace Aysheka\Curl\Option;

class ReturnTransfer implements Option
{
    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
    }
}
