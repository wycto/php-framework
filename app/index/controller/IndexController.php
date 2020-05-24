<?php


namespace app\index\controller;


use wycto\Request;

class IndexController
{
    function indexAction(){
        $re = Request::instance();
        dump($re->get());

        return "this IndexController indexAction";
    }
}