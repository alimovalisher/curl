<?php

namespace Aysheka\Curl\Exception;

use Aysheka\Curl\Exception\CurlException;

class InvalidMethod extends CurlException
{
    function __construct($method)
    {
        parent::__construct(sprintf('Invalid http method: %s', $method));
    }
}
