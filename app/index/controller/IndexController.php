<?php


namespace app\index\controller;


use wycto\Controller;

class IndexController extends Controller
{
    function indexAction(){
        $re = $this->request->param();
        dump($_SERVER);
        view();
    }
}