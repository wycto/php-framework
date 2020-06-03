<?php
declare(strict_types=1);

namespace app\index\controller;


use app\index\model\Test;
use wycto\Controller;
use wycto\Db;
use wycto\View;

class IndexController extends Controller
{

    function indexAction(){

        $db = Db::connect();
        $res = Db::table('weiyi')->getOne();
        dump($res);
    }
}