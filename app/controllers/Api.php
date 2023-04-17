<?php


class API {
    /**
     * the doc info will be generated automatically into service info page.
     * @params
     * @param $parameter
     * @param string $option
     */
    public function some_method(string $option = "foo")
    {
        return "some_method";
    }

    protected function client_can_not_see() {
    }
}

class ApiController extends \Yaf_Controller_Abstract {

    /***
     * @throws Exception
     */
    public function indexAction()
    {
        ob_end_clean();
        $service = new Yar_Server(new API());
        $service->handle();
    }

}