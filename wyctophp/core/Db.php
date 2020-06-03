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

    protected static $connect = null;

    protected static $instance = null;
    /**
     */
    function __construct()
    {
        if(self::$connect===null){
            $database = Config::get('database');
            $dbms = $database['type'];     //数据库类型
            $host = $database['hostname']; //数据库主机名
            $dbname = $database['database'];    //使用的数据库
            $username = $database['username'];      //数据库连接用户名
            $password = $database['password'];//对应的密码
            $persistent = $database['persistent'];//持久化

            $dsn="$dbms:host=$host;dbname=$dbname";
            $charset = $database['charset'];
            try {
                if($persistent){
                    $pdo = new \PDO($dsn, $username, $password,array(
                        \PDO::ATTR_PERSISTENT => true
                    )); //初始化一个PDO对象,持久连接
                }else{
                    $pdo = new \PDO($dsn, $username, $password); //初始化一个PDO对象
                }
                $pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);//抛出一个 PDOException
                //设置字符集
                $pdo->exec('SET NAMES ' . $charset);
                self::$connect = $pdo;
            } catch (\PDOException $e) {
                halt("Error!: " . $e->getMessage() . "<br/>");
            }
        }
    }

    /**
     * 连接数据库
     * @return \PDO|null
     */
    public static function connect(){
        if(self::$instance===null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 关闭连接
     */
    public static function disconnect(){
        self::$connect = null;
    }

    /**
     * 定义操作表
     * @param $table_name 表名称，去掉前缀
     * @return 返回当前对象实例 Db
     */
    public static function table($table_name){
        if(self::$instance===null){
            //self::connect();
        }
        self::$instance->table_name = $table_name;
        return self::$instance;
    }

    /**
     * query 查询
     * @return mixed
     */
    function query($sql){
        $PDOStatement = self::$connect->query($sql);
        return $PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 执行sql
     * @param $sql
     * @return false|int
     */
    function execute($sql){
        return self::$connect->exec($sql);
    }

    /**
     * 查询一条记录
     * @return mixed
     */
    function getOne(){
        $PDOStatement = self::$connect->query('SELECT * FROM ' . $this->table_name);
        return $PDOStatement->fetch(\PDO::FETCH_ASSOC);
    }
    /**
     * 查询结果集
     * @return mixed
     */
    public function getAll(){

        $PDOStatement = self::$connect->query('SELECT * FROM `' . $this->table_name);
        return $PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 获取数据库的版本号
     * @return mixed
     */
    public function getVersion(){
        return self::$connect->getAttribute(\PDO::ATTR_SERVER_VERSION);
    }
}
