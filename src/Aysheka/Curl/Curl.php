<?php
namespace Aysheka\Curl;

use Aysheka\Curl\Exception\InitializationException;
use Aysheka\Curl\Exception\IOException;
use Aysheka\Curl\Http\Method;
use Aysheka\Curl\Http\Response;
use Aysheka\Curl\Option\FollowLocation;
use Aysheka\Curl\Option\HeaderInResponse;
use Aysheka\Curl\Option\HeaderOut;
use Aysheka\Curl\Option\HttpBasicAuth;
use Aysheka\Curl\Option\HttpHeader;
use Aysheka\Curl\Option\HttpMethod;
use Aysheka\Curl\Option\HttpParameters;
use Aysheka\Curl\Option\HttpVersion10;
use Aysheka\Curl\Option\HttpVersion11;
use Aysheka\Curl\Option\MaximumRedirects;
use Aysheka\Curl\Option\Option;
use Aysheka\Curl\Option\Proxy;
use Aysheka\Curl\Option\ReturnTransfer;
use Aysheka\Curl\Option\SslVerify;
use Aysheka\Curl\Option\Url;
use Aysheka\Curl\Option\Verbose;
use Monolog\Logger;

/**
 * Class Curl
 * @package Aysheka\Curl
 */
class Curl
{
    /**
     * Curl logger
     *
     * @var \Monolog\Logger
     */
    private $logger;

    /**
     * Current curl url
     *
     * @var string
     */
    private $url;

    /**
     * Curl options
     *
     * @var array
     */
    private $options = [];

    function __construct(Logger $logger)
    {
        $this->setLogger($logger);
    }

    /**
     * Open curl
     *
     * @param string $url
     * @param Http\Method $method
     *
     * @return Curl
     */
    function open($url, Method $method = null)
    {
        /**
         * Initialize default options
         */
        $this->addOption(new HttpMethod(Method::get()));
        $this->addOption(new HttpVersion11());
        $this->addOption(new FollowLocation());
        $this->addOption(new HeaderOut());
        $this->addOption(new MaximumRedirects());
        $this->addOption(new ReturnTransfer());
        $this->addOption(new Url($url));

        if (null !== $method) {
            $this->addOption(new HttpMethod($method));
        }

        return $this;
    }

    /**
     * @param \Monolog\Logger $logger
     */
    protected function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return \Monolog\Logger
     */
    protected function getLogger()
    {
        return $this->logger;
    }


    /**
     * @return Curl
     */
    protected function getCurlInstance()
    {
        return new Curl($this->getLogger());
    }


    function disableSslVerifier()
    {
        $this->addOption(new SslVerify(false));

        return $this;
    }

    /**
     * Use proxy
     * @param      $url
     * @param      $port
     * @param null $username
     * @param null $password
     * @return $this
     */
    function overProxy($url, $port, $username = null, $password = null)
    {
        $this->addOption(new Proxy($url, $port, $username, $password));

        return $this;
    }

    /**
     * Use http 1.1 version
     * @return $this
     */
    function useHttpVersion1_1()
    {
        $this->addOption(new HttpVersion11());

        return $this;
    }

    /**
     * Use http 1.0 version
     * @return $this
     */
    function useHttpVersion1_0()
    {
        $this->addOption(new HttpVersion10());

        return $this;
    }

    /**
     * Set http method
     * @param $method
     *
     * @return Curl
     */
    function setHttpMethod(Method $method)
    {
        $this->addOption(new HttpMethod($method));

        return $this;
    }

    /**
     * Set http post parameters
     * @param array $parameters
     * @return Curl
     */
    function withParameters($parameters = array())
    {
        $this->addOption(new HttpParameters($parameters));

        return $this;
    }

    /**
     * Set curl option to verbose
     * @return $this
     */
    function verbose()
    {
        $this->addOption(new Verbose());

        return $this;
    }

    /**
     * Set http header
     * header array must be hash array
     * array(
     *   'header-name': 'header-value',
     * )
     * @param array $header
     * @return Curl
     */
    function withHeader(array $header)
    {
        $this->addOption(new HttpHeader($header));

        return $this;
    }

    /**
     * Use http basic-auth for authorization
     * @param string $username
     * @param string $password
     * @return Curl
     */
    function useHttpBasicAuth($username, $password)
    {
        $this->addOption(new HttpBasicAuth($username, $password));

        return $this;
    }

    /**
     * get header in response
     * @return Curl
     */
    function withHeaderInResponse()
    {
        $this->addOption(new HeaderInResponse());

        return $this;
    }

    /**
     * Execute http request
     * @return Response
     * @throws Exception\InitializationException
     * @throws Exception\IOException
     */
    function execute()
    {
        $curlHandler = $this->createCurlHandler();

        $this->initializeOptions($curlHandler);

        return $this->executeRequest($curlHandler);
    }

    /**
     * @param $curlHandler
     * @return Http\Response
     * @throws Exception\IOException
     */
    protected function executeRequest($curlHandler)
    {
        $this->addInfo('Executing request...');
        $content = curl_exec($curlHandler);

        if (curl_errno($curlHandler)) {
            throw new IOException($curlHandler);
        }

        $info = curl_getinfo($curlHandler);

        $this->addInfo('Request execution was completed', $info);
        $this->addInfo(sprintf("Response:\nCode:%d\nContentType:%s\nBody:\n%s\n", $info['http_code'], $info['content_type'], $content));
        $this->addInfo('Closing curl handler');

        curl_close($curlHandler);

        return new Response($content, $info['http_code'], $info['content_type']);
    }

    /**
     * @return resource
     * @throws Exception\InitializationException
     */
    protected function createCurlHandler()
    {
        $this->addInfo(sprintf('Opening: %s', $this->url));

        $curlHandler = curl_init($this->url);

        if (curl_errno($curlHandler)) {
            throw new InitializationException($curlHandler);
        }

        return $curlHandler;
    }

    /**
     * @param $curlHandler
     */
    protected function initializeOptions($curlHandler)
    {
        foreach ($this->options as $option) {
            $this->addInfo('Setup option', ['Option' => get_class($option)]);
            /** @var Option $option */
            $option->initialize($curlHandler);
        }
    }

    protected function addOption(Option $option)
    {
        $this->options[get_class($option)] = $option;
    }

    protected function getUrl()
    {
        return $this->url;
    }

    protected function addInfo($message, array $parameters = [])
    {
        $defaultParameters = ['Subject' => 'Curl', 'Url' => $this->getUrl()];
        $allParameters     = array_merge($parameters, $defaultParameters);
        $this->logger->info($message, $allParameters);
    }

}


