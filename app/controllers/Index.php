<?php

use Mszlu\Pb\User\UserRequest;
use Mszlu\Pb\User\UserResponse;
use Mszlu\Pb\User\UserServiceClient;



interface Middleware {
    public function run();
}

class Engine
{
    private array $middlewares = [];

    /**
     * @param array $middlewares
     */
    public function setMiddlewares(array $middlewares): void
    {
        $this->middlewares = $middlewares;
    }

    public function run()
    {

    }
}

class MiddlewareFunc
{
    public function methodHandler(Middleware $next): MiddlewareFunc
    {
        //todo

        //执行业务
        $next->run();

        //todo
        return $this;
    }
}

class User extends \Mszlu\Tools\Entity
{

    public mixed $id;
}

class IndexController extends  \Mszlu\Tools\YafSimpleController {


    public function demoAction()
    {
        $user = new User(['id' => 1001, 'age' => 20]);
        var_dump($user->id);
        var_dump($msg = $user->encode());
        var_dump($user::decode($msg)->toArray());
    }
    //保存一条配置,预测有请求. 创建配置-请求任务
    public function indexAction() {//默认Action

//        phpinfo();
        $host = "http://localhost:9000/server";
//        $client = new Yar_Client($host);
//        $result = $client->call("some_method", [1]);
//        var_dump($result);
//        var_dump(PHP_SAPI);
//        define('STDOUT', fopen('php://stdout', 'w'));
//        fwrite(STDOUT, "我是通过STDOUT写入；\n");
//
//        $stdout = fopen("php://stdout", "w");
//        fwrite($stdout, "我是通过php://stdout写入；\n");

        Yar_Concurrent_Client::call($host, "some_method", ["xiaoming"], function ($retval, $callinfo) {
            var_dump($retval);
            var_dump($callinfo);
//            fwrite(STDOUT, "Yar_Concurrent_Client写入；\n");
        });
        Yar_Concurrent_Client::loop(function ($retval, $callinfo) {
            var_dump("loop");
        });
        echo "end";
//        fclose($stdout);
    }

    public function demo2Action()
    {
        $request = new UserRequest();
        $request->setId([1, 2, 3]);
        $bin = $request->serializeToString();

        $copy = new UserRequest();
        $copy->mergeFromString($bin);
        var_dump($copy->getId()->count());

        //client demo
        $hostname = $this->getQuery('host', 'localhost:9111');

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


    }

}