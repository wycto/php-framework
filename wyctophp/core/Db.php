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
        if($table_name){
            $database = Config::get('database');
            $table_name = $database['prefix'] . $table_name;
            $this->table_name = $table_name;
        }
    }

    /**
     */
    function __destruct()
    {}

    /**
     * 连接数据库
     * @return \PDO|null
     */
    public static function connect($databaseName=null){
        if($databaseName!=null||self::$connect===null){
            $database = Config::get('database');
            $dbms = $database['type'];     //数据库类型
            $host = $database['hostname']; //数据库主机名
            $dbname = $databaseName?$databaseName:$database['database'];    //使用的数据库
            $username = $database['username'];      //数据库连接用户名
            $password = $database['password'];//对应的密码
            $persistent = $database['persistent'];//持久化

            $dsn="$dbms:host=$host;dbname=$dbname";
            $charset = $database['charset'];
            try {
                if($persistent&&$databaseName===null){
                    $pdo = new \PDO($dsn, $username, $password,array(
                        \PDO::ATTR_PERSISTENT => true
                    )); //初始化一个PDO对象,持久连接
                }else{
                    $pdo = new \PDO($dsn, $username, $password); //初始化一个PDO对象
                }
                $pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
                $pdo->exec('SET NAMES ' . $charset);
                self::$connect = $pdo;
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

    /**
     * query 查询
     * @return mixed
     */
    public function query(){

        $PDOStatement = self::$connect->query('SELECT * FROM `' . $this->table_name . '` limit 30');
        return $PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
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

        $PDOStatement = self::$connect->query('SELECT * FROM `' . $this->table_name . '` limit 30');
        return $PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 获取数据库的版本号
     * @return mixed
     */
    public static function getVersion(){
        return self::$connect->getAttribute(\PDO::ATTR_SERVER_VERSION);
    }

}
