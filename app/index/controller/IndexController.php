<?php


namespace app\index\controller;


use wycto\Request;

class IndexController
{
    function indexAction(){
        $re = Request::instance();
        view();
    }
}