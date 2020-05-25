<?php
namespace wycto;
class Request
{
    /**
     * @var object 对象实例
     */
    protected static $instance;

    public $module_name;

    public $controller_name;

    public $action_name;

    /**
     * @var array 当前调度信息
     */
    protected $dispatch = [];

    /**
     * 全局过滤规则
     * @var mixed|null
     */
    protected $filter;

    /**
     * 惯例配置
     * @var mixed|null
     */
    protected $config;

    /**
     * 是否多应用
     * @var mixed|null
     */
    protected $multi_module;

    /**
     * php://input
     * @var false|string
     */
    protected $input;

    public $request_url;

    /**
     * 构造函数
     * Request constructor.
     * @param array $options
     */
    protected function __construct($options = [])
    {
        $this->request_url  = $_SERVER['REQUEST_URI'];
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

    /**
     * 设置或者获取当前请求的调度信息
     * @access public
     * @param array $dispatch 调度信息
     * @return array
     */
    public function dispatch($dispatch = null)
    {
        if (!is_null($dispatch)) {
            $this->dispatch = $dispatch;
            $this->module_name = $dispatch['module']['module_name'];
            $this->controller_name = $dispatch['module']['controller_name'];
            $this->action_name = $dispatch['module']['action_name'];
        }
        return $this->dispatch;
    }

    /**
     * 调度执行
     * @return mixed
     */
    function execute(){
        $controller_classname = $this->controller_name . $this->config['app']['controller_suffix'];
        if($this->config['app']['multi_module']){
            if(!is_dir(ROOT_PATH . 'app' . DS . $this->module_name)){
                dump('模块：【' . $this->module_name . '】不存在');
            }
            $controller_classname = DS . 'app' . DS . $this->module_name . DS . 'controller' . DS . ucfirst($controller_classname);
        }else{
            $controller_classname = DS . 'app' . DS . 'controller' . DS . ucfirst($controller_classname);
        }

        $controller_classname = str_replace('/','\\',$controller_classname);

        if(class_exists($controller_classname)){
            $controller = new $controller_classname();

            if($this->config['app']['use_action_prefix']){
                $action_name = 'action' . ucfirst($this->action_name);
            }else{
                $action_name = $this->action_name . $this->config['app']['action_suffix'];
            }

            if(method_exists($controller,$action_name)){
                return $controller->$action_name();
            }else{
                dump('控制器方法：【' . $this->action_name . '】不存在');
            }

        }else{
            dump("控制器：【" . $this->controller_name . "】不存在");
        }
    }

    /**
     * 获取控制器
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controller_name;
    }

    /**
     * 获取模块
     * @return mixed
     */
    public function getModuleName()
    {
        return $this->module_name;
    }

    /**
     * 获取方法明
     * @return mixed
     */
    public function getActionName()
    {
        return $this->action_name;
    }

    /**
     * 获取请求参数 $_REQUEST
     * @param string $name 参数键
     * @param string $default 不存在默认值
     * @return array|mixed|string 返回
     */
    function param($name='',$default=''){
        if($name){
            return isset($_REQUEST[$name])?$_REQUEST[$name]:$default;
        }else{
            unset($_REQUEST[$this->request_url]);//卸载地址栏后面得url
            return $_REQUEST;
        }
    }

    /**
     * 获取请求参数 $_GET
     * @param string $name 参数键
     * @param string $default 不存在默认值
     * @return array|mixed|string 返回
     */
    function get($name='',$default=''){
        if($name){
            return isset($_GET[$name])?$_GET[$name]:$default;
        }else{
            unset($_GET[$this->request_url]);//卸载地址栏后面得url
            return $_GET;
        }
    }

    /**
     * 获取请求参数 $_POST
     * @param string $name 参数键
     * @param string $default 不存在默认值
     * @return array|mixed|string 返回
     */
    function post($name='',$default=''){
        if($name){
            return isset($_POST[$name])?$_POST[$name]:$default;
        }else{
            return $_POST;
        }
    }

}
