<?php
namespace wycto;
use \ArrayAccess;
class Model implements ArrayAccess
{
    protected static $instance;

    protected $data = [];

    protected $db;

    public function __construct() {
        $table = get_class($this);
        $table = substr($table,strripos($table,'\\')+1);
        $this->db = Db::table($table);
    }

    public static function find(){
        if(self::$instance===null){
            self::$instance = new static();
        }
        return self::$instance;
    }

    function getOne(){
        $this->data = array('name'=>'wyctophp','summary'=>'good php framework');
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
