<?php

class EnglishController extends \Yaf_Controller_Abstract {

    public $actions = [
        'review' => 'actions/English/Review.php',
        'search' => 'actions/English/Search.php',
        'recite' => 'actions/English/Recite.php',
        'association' => 'actions/English/Association.php',
        'revise' => 'actions/English/Revise.php',
        'search_add' => 'actions/English/Search/Add.php',
        'search_info' => 'actions/English/Search/Info.php',
    ];

    public function indexAction() {//默认Action
        echo (time());
    }
}