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
        $res = $db->execute('INSERT INTO weiyi VALUES(0,"weiyi","1","1")');
        $res = Db::table('weiyi')->order('id desc')->getOne();
        dump($res);
    }
}