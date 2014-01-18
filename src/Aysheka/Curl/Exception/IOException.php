<?php
namespace Aysheka\Curl\Exception;

class IOException extends CurlException
{
    function __construct($curl)
    {
        parent::__construct(sprintf('CURL error: %s', curl_error($curl)), curl_errno($curl));
    }
}
