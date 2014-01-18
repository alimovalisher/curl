<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 18.01.14
 * Time: 23:48
 */

namespace Aysheka\Curl\Tests;


use Aysheka\Curl\CurlFactory;
use Monolog\Logger;

class CurlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    function getAndExecute()
    {
        $curl = new CurlFactory(new Logger('curl'));

        $curl = $curl->get();
        $curl->open('google.ru');

        $response = $curl->execute();

        if (!$response->isSuccess()) {
            echo 'Can not execute request', "\n";
        }


        $response->getContent();
    }

}
 