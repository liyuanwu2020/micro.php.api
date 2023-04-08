<?php



define("APP_PATH",  realpath(dirname(__FILE__))); /* 指向public的上一级 */
require_once APP_PATH . '/vendor/autoload.php';

$port = 9119;
$server = new \Grpc\RpcServer([]);
$server->addHttp2Port('0.0.0.0:'.$port);
$server->handle(new \core\service\user\UserBasicInfo());
//$server->handle(new \core\service\user\UserService());
echo 'Listening on port :' . $port . PHP_EOL;
$server->run();