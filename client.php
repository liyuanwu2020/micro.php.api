<?php

use Mszlu\Pb\User\UserRequest;
use Mszlu\Pb\User\UserResponse;
use Mszlu\Pb\User\UserServiceClient;

define("APP_PATH",  realpath(dirname(__FILE__))); /* 指向public的上一级 */
require_once APP_PATH . '/vendor/autoload.php';

$hostname = !empty($argv[1]) ? $argv[1] : 'localhost:9111';
$request = new UserRequest();
$request->setId([1, 2, 3]);
$client = new UserServiceClient($hostname, [
    'credentials' => \Grpc\ChannelCredentials::createInsecure(),
]);

/**
 * @var UserResponse $response
 */
/**
 * @var \Grpc\Status $status
 */
list($response, $status) = $client->Search($request)->wait();
if ($status->code !== \Grpc\STATUS_OK) {
    echo "ERROR: " . $status->code . ", " . $status->details . PHP_EOL;
    exit(1);
}
var_dump($status);
var_dump($response->getId());
var_dump($response->getUsername());
var_dump($response->getArea()->getIterator());
var_dump($response->serializeToJsonString());
