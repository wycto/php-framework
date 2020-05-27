<?php
namespace wycto;

/**
 *
 * @author WeiYi
 *        
 */
class Db
{
    public static $connect = null;
    /**
     */
    function __construct()
    {}

    /**
     */
    function __destruct()
    {}

    public static function getConnect(){
        if(self::$connect===null){
            $dbms='mysql';     //数据库类型
            $host='127.0.0.1'; //数据库主机名
            $dbName='prison';    //使用的数据库
            $user='root';      //数据库连接用户名
            $pass='123qwe';          //对应的密码
            $dsn="$dbms:host=$host;dbname=$dbName";

            try {
                $dbh = new \PDO($dsn, $user, $pass); //初始化一个PDO对象
                self::$connect = $dbh;
            } catch (\PDOException $e) {
                halt("Error!: " . $e->getMessage() . "<br/>");
            }
        }

        return self::$connect;
    }
}
