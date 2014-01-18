curl
====

Curl abstract layer

Example
====

~~~~~ php

$curlFactory = new CurlFactory(new Logger('curl'));

$curl = $curlFactory->get();

$curl->open('google.ru');

$response = $curl->execute();

if (!$response->isSuccess()) {
    echo 'Can not execute request', "\n";
}

$response->getContent();