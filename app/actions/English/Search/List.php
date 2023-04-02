<?php


class Search_ListAction  extends \lib\yaf\TplAction {

    public function main()
    {
        $type = \modules\english\English::getEnglishTypeMap(true, true);

        $this->assign('type', $type, false);

        $this->assign('title', '单词搜索');
    }

    public function post(\entity\ApiEntity &$api)
    {
        $action = trim($this->getPost('action', ''));
        $p = intval($this->getPost('p', 0));
        $p = $p > 0 ? $p : 1;
        $keyword = trim($this->getPost('keyword', ''));
        $id = trim($this->getPost('id', ''));
        $type = trim($this->getPost('type', ''));
        $size = 10;


        switch ($action) {
            case 'delete':
                $api->data = \modules\english\English::delete($id);
                break;
            default:
                $api->data = \modules\english\English::search($type, $keyword, $p, $size);
                break;
        }

    }
}