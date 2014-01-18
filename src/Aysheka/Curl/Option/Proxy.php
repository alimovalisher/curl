<?php

namespace Aysheka\Curl\Option;

class Proxy implements Option
{
    private $url;
    private $port;
    private $username;
    private $password;

    function __construct($url, $port, $username = null, $password = null)
    {
        $this->url      = $url;
        $this->port     = $port;
        $this->username = $username;
        $this->password = $password;
    }

    function initialize($curlHandler)
    {
        if (null !== $this->getUrl()) {
            curl_setopt($curlHandler, CURLOPT_PROXY, $this->getUrl());
        }

        if (null !== $this->getPort()) {
            curl_setopt($curlHandler, CURLOPT_PROXYPORT, $this->port);
        }

        if (null !== $this->getUsername() || null !== $this->getPassword()) {
            curl_setopt($curlHandler, CURLOPT_PROXYUSERPWD, $this->getUserpwd());
        }
    }

    /**
     * @return string
     */
    protected function getUserpwd()
    {
        return sprintf('%s:%s', $this->getUsername(), $this->getPassword());
    }


    protected function getUrl()
    {
        return $this->url;
    }

    protected function getPort()
    {
        return $this->port;
    }

    protected function getUsername()
    {
        return $this->username;
    }

    protected function getPassword()
    {
        return $this->password;
    }

}
