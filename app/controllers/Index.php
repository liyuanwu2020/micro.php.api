<?php

use Mszlu\Pb\User\UserRequest;
use Mszlu\Pb\User\UserResponse;
use Mszlu\Pb\User\UserServiceClient;

class API {
    /**
     * the doc info will be generated automatically into service info page.
     * @params
     * @param $parameter
     * @param string $option
     * @return void
     */
    public function some_method($parameter, string $option = "foo"): void
    {
    }

    protected function client_can_not_see() {
    }
}

class IndexController extends  \Mszlu\Tools\YafSimpleController {


    //保存一条配置,预测有请求. 创建配置-请求任务
    public function indexAction() {//默认Action

        $service = new Yar_Server(new API());
        $service->handle();
    }

    public function serverAction()
    {
        //        server demo
        $port = 9112;
        $server = new \Grpc\RpcServer([]);
        $server->addHttp2Port('0.0.0.0:'.$port);
        $server->handle(new \core\service\user\UserBasicInfo());
        echo 'Listening on port :' . $port . PHP_EOL;
        $server->run();
    }

    public function demoAction()
    {
//        echo camelize("you_and_me");
//        var_dump(readableBytes(12214));

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