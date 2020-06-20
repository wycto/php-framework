<?php
namespace wycto;
use \ArrayAccess;
class Model implements ArrayAccess
{
    protected static $instance;

    protected $data = [];

    protected $table;

    protected $return_array = false;

    private $condition;

    public function __construct() {
        $table = get_class($this);
        $table = substr($table,strripos($table,'\\')+1);
        $prefix = Config::get('database.prefix');
        $this->table = $prefix . strtolower($table);
    }

    public static function find(){
        if(self::$instance===null){
            self::$instance = new static();
        }
        return self::$instance;
    }

    function where($where){
        $this->condition = $where;
        return $this;
    }

    function getOne(){
        $row = Db::table($this->table)->where($this->condition)->order()->getOne();
        $this->data = $row;
        if($this->return_array){
            return $this->data;
        }else{
            return $this;
        }
    }

    function toArray(){
        return $this->data;
    }

    function asArray(){
        $this->return_array = true;
        return $this;
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    function __get($name)
    {
        return $this->data[$name];
    }

    function __set($name,$value)
    {
        return $this->data[$name] = $value;
    }
}
