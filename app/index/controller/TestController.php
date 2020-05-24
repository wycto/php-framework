<?php


namespace app\index\controller;


use app\index\model\Test;
use wycto\Request;

class TestController
{
    protected $request;

    /**
     * 构造方法
     * @param Request $request Request对象
     * @access public
     */
    public function __construct()
    {
        //$this->request = $request;
    }

    function indexAction(){
        dump('您好，wyctophp框架，this is test controller index action');
    }

    function  runAction(){
        $row = Test::read();
        dump($row);
        //dump($this->request->getControllerName());
        return view();
    }
}