<?php



class ApiController extends \Yaf_Controller_Abstract {

    /***
     * @throws Exception
     */
    public function indexAction()
    {
        ini_set('display_errors', 1);
        error_reporting(-1);

//        phpinfo();exit;
        //todo 权限校验
        // 下列常量由此扩展定义，且仅在此扩展编译入 PHP 或在运行时动态载入时可用。
//        var_dump(YAR_VERSION, YAR_CLIENT_PROTOCOL_HTTP, YAR_PACKAGER_PHP, YAR_PACKAGER_JSON, YAR_ERR_OKEY, YAR_ERR_OUTPUT, YAR_ERR_TRANSPORT, YAR_ERR_REQUEST, YAR_ERR_PROTOCOL, YAR_ERR_PACKAGER, YAR_ERR_EXCEPTION);


    }

}