<?php

namespace Aysheka\Curl\Option;

use Aysheka\Curl\Http\Method;

class HttpMethod implements Option
{
    private $method;

    function __construct(Method $method)
    {
        $this->method = $method;
    }

    function initialize($curlHandler)
    {
        if ($this->method->isPost()) {
            curl_setopt($curlHandler, CURLOPT_POST, true);
        }
    }

}
