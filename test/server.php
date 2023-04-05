<?php
require dirname(__FILE__) . '/../vendor/autoload.php';


$port = 9112;
$server = new \Grpc\RpcServer();
$server->addHttp2Port('0.0.0.0:'.$port);
$server->handle(new \Pb\UserService());
echo 'Listening on port :' . $port . PHP_EOL;
$server->run();
