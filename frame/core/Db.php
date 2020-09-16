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

    protected $where;

    protected $order;

    protected $sql;

    protected static $connect = null;

    protected static $instance = null;
    /**
     */
    private function __construct()
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

    private function __clone(){}

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
     * @param $table_name 表名称
     * @param $prefix 前缀，是否加表前缀，true是，默认否
     * @return 返回当前对象实例 Db
     */
    public static function table($table_name,$prefix=false){
        if(self::$instance===null){
            self::$instance = new self();
        }

        if($prefix){
            $table_name = Config::get('database.prefix').$table_name;
        }
        self::$instance->table_name = $table_name;
        return self::$instance;
    }

    /**
     * 定义操作表，带配置里面的前缀
     * @param $table_name 表名称
     * @return 返回当前对象实例 Db
     */
    public static function name($table_name){
        if(self::$instance===null){
            self::$instance = new self();
        }

        $table_name = Config::get('database.prefix').$table_name;

        self::$instance->table_name = $table_name;
        return self::$instance;
    }

    /**
     * query 查询
     * @param $sql SQL语句
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
        $this->sql = 'SELECT * FROM `' . $this->table_name . '`';
        if($this->where){
            $this->sql .=  ' where ' . $this->where;
            $this->where = null;
        }

        if($this->order){
            $this->sql .=  ' ORDER BY ' . $this->order;
        }

        $PDOStatement = self::$connect->prepare($this->sql);
        $PDOStatement->execute();
        return $PDOStatement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * 查询结果集
     * @return mixed
     */
    public function getAll(){

        $this->sql = 'SELECT * FROM `' . $this->table_name . '`';
        if($this->where){
            $this->sql .=  ' where ' . $this->where;
        }

        if($this->order){
            $this->sql .=  ' ORDER BY ' . $this->order;
        }

        $PDOStatement = self::$connect->prepare($this->sql);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 查询条件
     * @param $where
     * @return $this
     */
    public function where($where=null){
        if($where){
            $where_str = '';
            if(is_array($where)){
                foreach ($where as $key=>$val){
                    if($where_str){
                        $where_str .= ' AND `' . $key . '`="' . $val . '"';
                    }else{
                        $where_str .= '`' . $key . '`="' . $val.'"';
                    }
                }
            }elseif(is_string($where)){
                $where_str = $where;
            }

            if($where_str){
                if($this->where){
                    $this->where .= " AND " . $where_str;
                }else{
                    $this->where = $where_str;
                }
            }
        }
        return $this;
    }

    /**
     * 排序
     * @param $order
     * @return $this
     */
    function order($order=null){
        if(!empty($order)){
            $order_str = '';
            if(is_array($order)){
                $i = 0;
                foreach ($order as $key=>$val){
                    if($i){
                        $order_str .= ',`' . $key . '` ' . $val;
                    }else{
                        $order_str .= '`' . $key . '` ' . $val;
                    }
                    $i++;
                }
            }elseif(is_string($order)){
                $order_str = $order;
            }

            if($order_str){
                $this->order = $order_str;
            }
        }
        return $this;
    }

    /**
     * 新增数据
     * @param $dataArr 新增数据数组
     * @return false|int 返回受影响的行数
     */
    function insert($dataArr){
        $fieldStr = '';
        $valuesStr = '';
        $sql = '';
        $result = 0;

        foreach ($dataArr as $key=>$val){
            if($fieldStr){
                $fieldStr .= ',`'.$key.'`';
                $valuesStr .= ',"'.$val.'"';
            }else{
                $fieldStr .= '`'.$key.'`';
                $valuesStr .= '"'.$val.'"';
            }
        }

        if($fieldStr&&$valuesStr){
            $sql = 'INSERT INTO '.$this->table_name.' ('.$fieldStr.') VALUES ('.$valuesStr.')';
        }

        if($sql){
            $PDOStatement = self::$connect->prepare($sql);
            $result = $PDOStatement->execute();
        }

        return $result;
    }

    /**
     * 更新数据
     * @param $dataArr 更新的数据
     * @param $where 更新条件
     * @return false|int 返回更新的记录数
     */
    function update($dataArr,$where){
        $setStr = '';
        $whereStr = '';
        $sql = '';
        $result = 0;

        foreach ($dataArr as $key=>$val){
            if($setStr){
                $setStr .= ',`'.$key.'`="'.$val.'"';
            }else{
                $setStr .= '`'.$key.'`="'.$val.'"';
            }
        }

        foreach ($where as $key=>$val){
            if($whereStr){
                $whereStr .= ' AND `'.$key.'`="'.$val.'"';
            }else{
                $whereStr .= '`'.$key.'`="'.$val.'"';
            }
        }

        if($setStr){
            $sql = 'UPDATE '.$this->table_name.' SET '.$setStr;
        }

        if($sql&&$whereStr){
            $sql .= ' WHERE '.$whereStr;
        }

        if($sql){
            $PDOStatement = self::$connect->prepare($sql);
            $result = $PDOStatement->execute();
        }

        return $result;
    }

    /**
     * delete 删除数据
     * @return false|int
     */
    public function delete($where,$all=false){
        $whereStr = '';
        foreach ($where as $key=>$val){
            if($whereStr){
                $whereStr .= ' AND `'.$key.'`="'.$val.'"';
            }else{
                $whereStr .= '`'.$key.'`="'.$val.'"';
            }
        }

        if(empty($whereStr)&&!$all){
            return 0;
        }

        $this->sql = 'DELETE FROM `' . $this->table_name . '`';

        if($whereStr){
            $this->sql .= ' WHERE '.$whereStr;
        }

        $PDOStatement = self::$connect->prepare($this->sql);
        return $PDOStatement->execute();
    }

    /**
     * 获取表结构信息
     * @param null $key 指定返回信息，Field、Type、Comment...
     * @param bool $field_index 返回字段索引
     * @return array 返回数组
     */
    function getFieldsInfo($key=null,$field_index=false){
        $returnArr = [];

        $PDOStatement = self::$connect->prepare('SHOW FULL FIELDS FROM '.$this->table_name);
        $PDOStatement->execute();
        $fieldsInfoArr = $PDOStatement->fetchAll(\PDO::FETCH_ASSOC);

        if($field_index||$key){
            foreach ($fieldsInfoArr as $fieldsInfo){
                $valArr = $fieldsInfo[$key];
                if(empty($key)){
                    $valArr = $fieldsInfo;
                }

                if($field_index){
                    $returnArr[$fieldsInfo['Field']] = $valArr;
                }else{
                    $returnArr[] = $valArr;
                }
            }
        }else{
            $returnArr = $fieldsInfoArr;
        }

        return $returnArr;
    }
    /**
     * 获取数据库的版本号
     * @return mixed
     */
    public function getVersion(){
        return self::$connect->getAttribute(\PDO::ATTR_SERVER_VERSION);
    }
}
