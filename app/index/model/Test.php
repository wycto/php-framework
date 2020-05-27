<?php


namespace app\index\model;

use wycto\Db;
class Test
{
    protected static $data = [];

    public static function read(){
        return array('name'=>'wyctophp','summary'=>'good php framework');
    }

    public static function select(){
        $con = Db::connect();
        $re = $con->prepare('select * from prisoner limit 30');
        $re->execute();
        $re->setFetchMode(\PDO::FETCH_ASSOC);
        $all = $re->fetchAll();

        self::$data = $all;
        return self;
    }

    function __get($name)
    {
        // TODO: Implement __get() method.
        return '__get';
    }
}