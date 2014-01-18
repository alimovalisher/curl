<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 18.01.14
 * Time: 23:16
 */

namespace Aysheka\Curl;

use Monolog\Logger;

/**
 * Class CurlFactory
 * @package Aysheka\Curl
 */
class CurlFactory
{
    private $logger;

    /**
     * @param Logger $logger
     */
    function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Curl
     */
    function get()
    {
        return new Curl($this->logger);
    }
} 