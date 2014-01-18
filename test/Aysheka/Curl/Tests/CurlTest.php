<?php
namespace Aysheka\Curl\Tests;

use Aysheka\Curl\Curl;
use Aysheka\Curl\Http\Method;
use Monolog\Logger;

/**
 * Test class for Curl.
 * Generated by PHPUnit on 2012-02-28 at 18:13:26.
 */
class CurlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Curl
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $curl         = new Curl(new Logger('Logger'));
        $this->object = $curl->open('http://ya.ru');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Aysheka\Curl\Curl::execute
     */
    function testSuccessfullySend()
    {
        $response = $this->object->withHeader(array('Content-type' => 'text/html'))->execute();

        $this->assertInstanceOf('Aysheka\Curl\Http\Response', $response);
    }


    /**
     * @covers Aysheka\Curl\Curl::execute
     * @expectedException \Aysheka\Curl\Exception\CurlException
     */
    function testBadInit()
    {
        $this->object->open('http://adsadadadasdad.d/dsad', Method::post())->execute();
    }

    function testExecutionWithProxy()
    {
        $this->object->open('http://google.ru', Method::post())
            ->overProxy('', 8080)
            ->withHeader(['Expect' => ''])
            ->verbose()
            ->withParameters(['q' => 'Text'])->execute();
    }

    /**
     * @covers Aysheka\Curl\Curl::execute
     */
    function testSendPostRequest()
    {
        $response = $this->object->open('http://ya.ru', Method::get())
            ->withParameters(array('text' => 'Text'))

            ->execute();
        $this->assertInstanceOf('Aysheka\Curl\Http\Response', $response);
    }
}
