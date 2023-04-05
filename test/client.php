<?php
require dirname(__FILE__) . '/../vendor/autoload.php';


$hostname = !empty($argv[1]) ? $argv[1] : 'localhost:9111';


$client = new \Pb\UserServiceClient($hostname, [
    'credentials' => \Grpc\ChannelCredentials::createInsecure(),
]);
$request = new \Pb\UserRequest();
$request->setId([1, 2, 3]);

/**
 * @var \Pb\UserResponse $response
*/
/**
 * @var \Grpc\Status $status
 */
list($response, $status) = $client->Search($request)->wait();
if ($status->code !== Grpc\STATUS_OK) {
    echo "ERROR: " . $status->code . ", " . $status->details . PHP_EOL;
    exit(1);
}
var_dump($status);
var_dump($response->getId());
var_dump($response->getUsername());
var_dump($response->getArea()->getIterator());
var_dump($response->serializeToJsonString());
