<?php

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

class IndexController extends  \Mszlu\Tools\CYafSimpleController {


    //保存一条配置,预测有请求. 创建配置-请求任务
    public function indexAction() {//默认Action

        $service = new Yar_Server(new API());
        $service->handle();
    }

    public function demoAction()
    {
//        echo camelize("you_and_me");
        var_dump($this->getQuery());
        var_dump(\Mszlu\Tools\readableBytes(12214));
    }

}