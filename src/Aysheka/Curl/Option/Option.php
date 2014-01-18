<?php

namespace Aysheka\Curl\Option;

/**
 * Curl option, that must accept parameter and modify Curl execution workflow
 */
interface Option
{
    function initialize($curlHandler);
}
