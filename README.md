curl
====

Curl abstract layer

Example
====

~~~~~ php

$curl = new CurlFactory(new Logger('curl'));

$curl = $curl->get();
$curl->open('google.ru');

$response = $curl->execute();

if (!$response->isSuccess()) {
    echo 'Can not execute request', "\n";
}

$response->getContent();