<?php


namespace app\index\controller;


use app\index\model\Test;
use wycto\Db;
use wycto\Log;
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
        $re = Db::table("account")->where(['code'=>"10003"])->getOne();

            if(empty($re)){
                dump("空");
            }else{
                dump($re);
            }
    }

    function  runAction(){
        $row = Test::read();
        dump($row);
        //dump($this->request->getControllerName());
        return view();
    }
}
