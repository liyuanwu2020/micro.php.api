<?php


class SearchAction  extends \lib\yaf\TplAction {

    public function main()
    {

        echo 1111;



        echo 2222, PHP_EOL;

//        phpinfo();
//        var_dump($_SERVER);exit;
        \model\english\EnglishNotesDb::action(function(){
//sleep(2);
            $rs = \model\english\EnglishNotesDb::get('id');
//        usleep(rand(0, 1000) * 1000);
            echo microtime() . ' count:', $rs;
        });

//echo uniqid();
//echo date("Y-m-d H:i:s ");DbConfig
        exit;
        var_dump("2020a09 22" > "2020!09-22");

        exit;
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