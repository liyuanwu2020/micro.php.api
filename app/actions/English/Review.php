<?php


class ReviewAction  extends \lib\yaf\TplAction {

    public function main()
    {

        $this->assign('title', 'memory review');
    }

    public function post(\entity\ApiEntity &$api)
    {
        $action = trim($this->getPost('action', ''));
        $p = intval($this->getPost('p', 0));
        $p = $p > 0 ? $p : 1;
        $keyword = trim($this->getPost('keyword', ''));
        $id = trim($this->getPost('id', ''));
        $type = trim($this->getPost('type', ''));
        $size = 20;

        switch ($action) {
            case 'delete':
                $api->data = \modules\english\English::delete($id);
                break;
            default:

                $api->data = \modules\english\Review::search($type, $keyword, $p, $size);
                break;
        }

    }
}