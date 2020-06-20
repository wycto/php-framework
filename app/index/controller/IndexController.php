<?php
declare(strict_types=1);

namespace app\index\controller;

use app\index\model\User;
use wycto\Controller;

class IndexController extends Controller
{

    function indexAction(){

        /*$db = Db::connect();
        $res = $db->execute('INSERT INTO weiyi VALUES(0,"weiyi","1","1")');
        $res = Db::table('weiyi')->order('id desc')->getAll();
        dump($res);*/
        $data = User::find()->where(array('uid'=>3))->getOne();
        dump($data);
        dump($data['nickname']);
        dump($data->nickname);
    }
}