<?php


class ReviseAction  extends \lib\yaf\TplAction {

    public function main()
    {
        //五一黄金复习法
        //一小时后,一天后,一周后,一个月后,一个季度后

        $this->assign('title', '单词复习');
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
                $api->data = \modules\english\English::search($type, $keyword, $p, $size);
                break;
        }

    }
}