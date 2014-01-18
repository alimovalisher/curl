<?php

namespace Aysheka\Curl\Option;

class HttpVersion10 extends HttpVersion11
{
    protected function getVersion()
    {
        return CURL_HTTP_VERSION_1_0;
    }

}
