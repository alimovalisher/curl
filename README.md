curl
====

Curl abstract layer

Example
====

~~~~~ php

$curl = CurlFactory::get();
$curl->open('google.ru');

$response = $curl->execute();

if(!$response->isSuccess()){
    echo 'Can not execute request',"\n";
}


$response->getContent();
