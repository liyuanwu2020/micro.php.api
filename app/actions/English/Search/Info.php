<?php


class Search_InfoAction  extends \lib\yaf\TplAction {

    const DISPLAY_TPL = false;

    public function main()
    {

    }

    public function post(\entity\ApiEntity &$api)
    {
        $id = trim($this->getPost('id'));

        $api->data = $id > 0 ? \modules\english\English::getItem($id) : null;

    }
}