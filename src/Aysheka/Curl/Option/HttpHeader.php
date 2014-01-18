<?php

namespace Aysheka\Curl\Option;

class HttpHeader implements Option
{
    private $headers = [];

    function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    function initialize($curlHandler)
    {
        curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $this->getHeader());
    }

    /**
     * Get serialized header array
     * @return array
     */
    protected function getHeader()
    {
        $header = array();

        foreach ($this->headers as $key => $value) {
            $header[] = sprintf('%s: %s', $key, $value);
        }

        return $header;
    }
}
