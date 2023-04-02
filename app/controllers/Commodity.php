<?php


class CommodityController extends Yaf_Controller_Abstract {
    public function indexAction() {//默认Action
        echo '商品';
    }
    public function itemAction() {//默认Action
        echo '商品1111111';
    }
    public function index2Action() {//默认Action
        echo __FUNCTION__;
    }
}