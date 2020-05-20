<?php


namespace app\index\controller;


use app\index\model\Test;

class TestController
{
    function indexAction(){
        dump('您好，wyctophp框架，this is test controller index action');
    }

    function  runAction(){
        $row = Test::read();
        dump($row);

    }
}