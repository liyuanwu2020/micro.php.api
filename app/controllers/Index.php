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

class IndexController extends  \Mszlu\Tools\YafSimpleController {


    //保存一条配置,预测有请求. 创建配置-请求任务
    public function indexAction() {//默认Action

//        phpinfo();
        $host = "http://localhost:9000/api/index/";
        $client = new Yar_Client($host);
        $result = $client->call("some_method", ["1"]);
        var_dump($result);
        var_dump("hello");
//        echo camelize("you_and_me");
//        var_dump(readableBytes(12214));

    }

    public function demoAction()
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