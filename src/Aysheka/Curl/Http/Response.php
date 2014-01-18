<?php
namespace Aysheka\Curl\Http;

class Response
{
    private $content;
    private $code;
    private $contentType;


    function __construct($content, $code, $contentType)
    {
        $this->content     = $content;
        $this->code        = $code;
        $this->contentType = $contentType;
    }

    /**
     * Get http content
     * @return mixed
     */
    function getContent()
    {
        return $this->content;
    }

    /**
     * Get HTTP content-type
     * @return mixed
     */
    function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Get http code
     * @return mixed
     */
    function getCode()
    {
        return $this->code;
    }

    /**
     * Check if http code is 200
     * @return bool
     */
    function isSuccess()
    {
        return (in_array($this->code, array(200)));
    }
}
