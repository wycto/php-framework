<?php


namespace wycto;


class Response
{

    /**
     * @var object 对象实例
     */
    protected static $instance;

    /**
     * 构造函数
     * Response constructor.
     */
    public function __construct($options = [])
    {

    }

    /**
     * 初始化
     * @param array $options
     * @return object|static
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }
        return self::$instance;
    }

    /**
     * 响应发送数据
     * @param $data
     */
    function send($data){
        echo $data;

        if (function_exists('fastcgi_finish_request')) {
            // 提高页面响应
            fastcgi_finish_request();
        }
    }
}