<?php


namespace app\admin\controller;


use wycto\View;

class IndexController
{
    function indexAction(){
        View::instance()->assign('name','weiyi');
        return view();
    }
}