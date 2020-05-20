<?php
namespace wycto;
class Request
{
    /**
     * @var object 对象实例
     */
    protected static $instance;

    /**
     * 全局过滤规则
     * @var mixed|null
     */
    protected $filter;

    /**
     * php://input
     * @var false|string
     */
    protected $input;

    /**
     * 构造函数
     * Request constructor.
     * @param array $options
     */
    protected function __construct($options = [])
    {
        foreach ($options as $name => $item) {
            if (property_exists($this, $name)) {
                $this->$name = $item;
            }
        }
        if (is_null($this->filter)) {
            $this->filter = Config::get('app.default_filter');
        }

        // 保存 php://input
        $this->input = file_get_contents('php://input');
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
     * 销毁当前请求对象
     */
    public static function destroy()
    {
        if (!is_null(self::$instance)) {
            self::$instance = null;
        }
    }
}
