<?php

/**
 * 当有未捕获的异常, 则控制流会流到这里
 */
class ErrorController extends \Yaf_Controller_Abstract
{
    /**
     * 此时可通过$request->getException()获取到发生的异常
     */
    public function errorAction()
    {
        $exception = $this->getRequest()->getException();

        try {
            throw $exception;
        } catch (\Yaf_Exception_LoadFailed | \Yaf_Exception_LoadFailed_View $e) {
            //加载失败
            $message = '加载失败:';
        } catch (\Yaf_Exception $e) {
            //其他错误
            $message = '框架错误:';
        } catch (Exception|Error $e) {
            $message = '业务错误:';
        } finally {
            ob_end_clean();
            print_r($e);

//            $this->assign('message', );
//            $this->display('error');
        }
    }

    public function assign($name, $value = null)
    {
        $loop = is_array($name) ? $name : [$name => $value];

        foreach ($loop as $k => $v) {
            $this->getView()->assign($k, $v);
        }

    }
}