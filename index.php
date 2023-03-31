<?php

/*  文档http://www.laruence.com/manual/yaf.constant.html
    YAF_VERSION(Yaf\VERSION)	Yaf框架的三位版本信息
    YAF_ENVIRON(Yaf\ENVIRON	Yaf的环境常量, 指明了要读取的配置的节, 默认的是product
    YAF_ERR_STARTUP_FAILED(Yaf\ERR\STARTUP_FAILED)	Yaf的错误代码常量, 表示启动失败, 值为512
    YAF_ERR_ROUTE_FAILED(Yaf\ERR\ROUTE_FAILED)	Yaf的错误代码常量, 表示路由失败, 值为513
    YAF_ERR_DISPATCH_FAILED(Yaf\ERR\DISPATCH_FAILED)	Yaf的错误代码常量, 表示分发失败, 值为514
    YAF_ERR_NOTFOUND_MODULE(Yaf\ERR\NOTFOUD\MODULE)	Yaf的错误代码常量, 表示找不到指定的模块, 值为515
    YAF_ERR_NOTFOUND_CONTROLLER(Yaf\ERR\NOTFOUD\CONTROLLER)	Yaf的错误代码常量, 表示找不到指定的Controller, 值为516
    YAF_ERR_NOTFOUND_ACTION(Yaf\ERR\NOTFOUD\ACTION)	Yaf的错误代码常量, 表示找不到指定的Action, 值为517
    YAF_ERR_NOTFOUND_VIEW(Yaf\ERR\NOTFOUD\VIEW)	Yaf的错误代码常量, 表示找不到指定的视图文件, 值为518
    YAF_ERR_CALL_FAILED(Yaf\ERR\CALL_FAILED)	Yaf的错误代码常量, 表示调用失败, 值为519
    YAF_ERR_AUTOLOAD_FAILED(Yaf\ERR\AUTOLOAD_FAILED)	Yaf的错误代码常量, 表示自动加载类失败, 值为520
    YAF_ERR_TYPE_ERROR(Yaf\ERR\TYPE_ERROR)	Yaf的错误代码常量, 表示关键逻辑的参数错误, 值为521
*/

define("APP_PATH",  realpath(dirname(__FILE__))); /* 指向public的上一级 */

var_dump(APP_PATH);
//const VIEW_PATH = APP_PATH . "/views";
//const __VERSION__ = '1.0';
////setcookie('XDEBUG_SESSION', 'PHPSTORM');
//
//$ini = ini_get('yaf.environ');
//$section = $ini ?: 'product';
//
//try {
//    $config = new Yaf_Config_Ini(APP_PATH . "/conf/application.ini", $section);
//    $app = new Yaf_Application($config->toArray());
//    $app
//        ->bootstrap() //Bootstrap, 也叫做引导程序. 它是Yaf提供的一个全局配置的入口, 在Bootstrap中, 你可以做很多全局自定义的工作.
//        ->run();
//} catch (Yaf_Exception_StartupError | Yaf_Exception_TypeError $e) {
//    echo $e->getMessage();
//}

