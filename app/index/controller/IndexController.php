<?php


namespace app\index\controller;


use app\index\model\Test;
use wycto\Controller;
use wycto\Db;
use wycto\View;

class IndexController extends Controller
{

    function indexAction(){

        $con = Db::connect();
        //$re = $con->prepare('select * from prisoner limit 30');
        /*dump($re->execute());
        dump($re->setFetchMode(\PDO::FETCH_ASSOC));*/
//        $re->execute();
//        $re->setFetchMode(\PDO::FETCH_ASSOC);
//        $all = $re->fetchAll();
//        $all = $this->array_to_object($all);
        $rows = Db::table('user')->select();
        dump($rows);
        View::instance()->assign('all',$rows);
        //view();

    }

    function array_to_object($arr) {
        if (gettype($arr) != 'array') {
            return;
        }
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $re = $this->array_to_object($v);
                $arr[$k] = (object)$re;
            }
        }

        return (object)$arr;
    }
}