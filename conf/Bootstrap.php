
<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

class Bootstrap extends Yaf_Bootstrap_Abstract{

    private static $config =  null;
    //配置文件保存
    public function _initConfig() {
        Yaf_Registry::set("config", self::getConfig());
    }

    /**
     * 自动加载配置
     * @throws Exception
     */
    public function _initError()
    {
//        set_error_handler(function($errorNo, $message, $filename, $lineNo){
//            throw new Exception ( 'PHP error('.$errorNo.') in file ' . $filename . ' (' . $lineNo . '): ' . $message, 0 );
//        });
    }


    /**
     * 注册路由配置
     * @author kevin
     * 2014-3-14
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initRoute(Yaf_Dispatcher $dispatcher){
        $router = Yaf_Dispatcher::getInstance()->getRouter();
        $router->addConfig(Yaf_Registry::get("config")->routes);
    }

    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {
        // 注册一个插件

    }

    public function _initSessionHandler()
    {
//        session_set_save_handler(new \lib\session\DbSessionHandler(), true);
    }

    /**
     * 关闭视图
     */
    public function _initView()
    {
//        Yaf_Dispatcher::getInstance()->setView(new Yaf_View_Simple(VIEW_PATH));
    }

    /**
     * 关闭视图
     */
    public function _initRequest()
    {

    }


    /**
     * 获取配置文件
     * @return Yaf_Config_Abstract|null
     */
    private static function getConfig(): ?Yaf_Config_Abstract
    {
        return self::$config instanceof Yaf_Config_Abstract ? self::$config : self::$config = Yaf_Application::app()->getConfig()->get('application');
    }
}