<?php
namespace wycto;

/**
 *
 * @author WeiYi
 *        
 */
class Db
{
    protected $table_name;

    public static $connect = null;

    protected static $instance;
    /**
     */
    function __construct($table_name='')
    {
        $this->table_name = $table_name;
    }

    /**
     */
    function __destruct()
    {}

    /**
     * 连接数据库
     * @return \PDO|null
     */
    public static function connect(){
        if(self::$connect===null){
            $database = Config::get('database');
            $dbms = $database['type'];     //数据库类型
            $host = $database['hostname']; //数据库主机名
            $dbname = $database['database'];    //使用的数据库
            $username = $database['username'];      //数据库连接用户名
            $password = $database['password'];//对应的密码
            $persistent = $database['persistent'];//持久化

            $dsn="$dbms:host=$host;dbname=$dbname";

            try {
                if($persistent){
                    $dbh = new \PDO($dsn, $username, $password,array(
                        \PDO::ATTR_PERSISTENT => true
                    )); //初始化一个PDO对象,持久连接
                }else{
                    $dbh = new \PDO($dsn, $username, $password); //初始化一个PDO对象
                }
                self::$connect = $dbh;
            } catch (\PDOException $e) {
                halt("Error!: " . $e->getMessage() . "<br/>");
            }
        }

        return self::$connect;
    }

    /**
     * 关闭连接
     */
    public static function disconnect(){
        self::$connect = null;
    }

    public static function table($name){
        if(self::$instance===null){
            self::$instance = new self($name);
        }
        return self::$instance;
    }

    /**
     * 查询结果集
     * @return mixed
     */
    public function select(){

        return self::$connect->query('SELECT * from `' . $this->table_name . '` limit 30')->fetchAll(\PDO::FETCH_ASSOC);
    }

}
