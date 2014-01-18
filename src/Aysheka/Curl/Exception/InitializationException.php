<?php
namespace Aysheka\Curl\Exception;

class InitializationException extends CurlException
{
    function __construct($curl)
    {
        parent::__construct(sprintf('Cannot Initialize curl: %s', curl_error($curl)), curl_errno($curl));
    }
}
