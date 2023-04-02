<?php


class Search_AddAction  extends \lib\yaf\TplAction {

    public function main()
    {

        $id = trim($this->getQuery('id'));

        $title = strlen($id) ? '修改' : '新增';

        $type = \modules\english\English::getEnglishTypeMap(true);

        $this->assign(compact('title', 'id'));

        $this->assign('type', $type, false);

        $this->js([
            'jquery.tagsinput.js',
        ]);
        $this->css([
            'jquery.tagsinput.css',
        ]);
    }

    /**
     * @param \lib\entity\ApiEntity $api
     * @return bool|void
     * @throws Exception
     */
    public function post(\lib\entity\ApiEntity &$api)
    {
        $data = $this->getPost();
        $data['tags'] = explode(",", $data['tags'] ?? '');
        $data['content'] = \modules\english\English::formatContent($data['content'] ?? '');
        $entity = new \lib\entity\es\EntityEnglish($data);
        $update = $entity->id > 0;

        //写入数据库
        $id = \modules\english\English::add2Db($entity);

        //todo 写入es,异步执行
        $dbEntity = \modules\english\English::getInfo2Db($id);

        $response = \modules\english\English::add2Es($dbEntity);

        $api->msg = $update ? '修改成功' : '添加成功';
        $api->data = $response;
    }

}