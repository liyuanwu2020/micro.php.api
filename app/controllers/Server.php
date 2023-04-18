<?php



class ServerController extends  \Mszlu\Tools\YafSimpleController {

    public function indexAction() {//默认Action
        ob_end_clean();
        $service = new Yar_Server(new API());
        $service->handle();
    }

}

class API {
    /**
     * the doc info will be generated automatically into service info page.
     * @params
     * @return
     */
    public function some_method($option = "foo") {
        return "hello" . $option;
    }

    public function client_can_not_see() {
    }
}