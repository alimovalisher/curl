<?php
namespace Aysheka\Curl\Http;


/**
 * Http method
 */
class Method
{
    private static $getMethod = true;
    private static $postMethod = false;

    private $method;

    final private function __construct()
    {
        $this->method = self::$getMethod;
    }

    /**
     * Get instance with default GET value
     * @internal param bool $type
     * @return Method
     * @deprecated since 2.1 will be removed in 2.3
     */
    static function create()
    {
        return new self();
    }

    /**
     * @return Method
     */
    static function post()
    {
        $instance         = new self();
        $instance->method = self::$postMethod;

        return $instance;
    }

    /**
     * @return Method
     */
    static function get()
    {
        $instance         = new self();
        $instance->method = self::$getMethod;

        return $instance;
    }


    function isPost()
    {
        return (self::$getMethod !== $this->method) ? true : false;
    }
}
