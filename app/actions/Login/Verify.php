<?php


use entity\ApiEntity;

class VerifyAction  extends \lib\yaf\TplAction {

    const DISPLAY_TPL = false;

    public function main()
    {

        return false;
    }

    /**
     * @param ApiEntity $api
     * @return bool|void
     * @throws Exception
     */
    public function post(ApiEntity &$api)
    {
        $username = trim($this->getPost('username', null));
        $passwd = trim($this->getPost('passwd', null));

        \modules\user\Login::verify($username, $passwd);

        $api->msg = 'login success';
    }

}