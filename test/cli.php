<?php


require dirname(__FILE__) . '/../vendor/autoload.php';

$obj = new \Service\SearchRequest();
$obj->setPageNumber(1);
$obj->setQuery("what");
$obj->setResultPerPage(20);

$bin = $obj->serializeToString();

$copy = new \Service\SearchRequest();
$copy->mergeFromString($bin);
var_dump($copy->getQuery());