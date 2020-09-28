<?php


namespace app\index\controller;


use app\index\model\Test;
use wycto\Db;
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
        //header("Content-Type: text/html; charset=utf-8");
        dump(ROOT_PATH);
        $re = exec("D:\ProgramData\Anaconda3\python ".ROOT_PATH."/python/index.py E:\wwwroot\python3\pythontest\\excel\普联科技离职工资8月.xlsx ".urlencode("E:\wwwroot\python3\pythontest\\excel\哦豁.xls"),$output,$return_var);
        dump($output);
        dump(json_decode($output[0],true));
        //dump($re);
//        foreach ( as $out){
//            dump($out);
//        }
    }

    function  runAction(){
        $row = Test::read();
        dump($row);
        //dump($this->request->getControllerName());
        return view();
    }
}
