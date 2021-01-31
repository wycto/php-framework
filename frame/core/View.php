<?php
namespace wycto;

class View
{
    // 视图实例
    protected static $instance;

    // 模板变量
    protected $data = [];

    /**
     * 初始化视图
     * @return View
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 模板变量赋值
     * @access public
     * @param mixed $name  变量名
     * @param mixed $value 变量值
     * @return $this
     */
    public function assign($name, $value = '')
    {
        if (is_array($name)) {
            $this->data = array_merge($this->data, $name);
        } else {
            $this->data[$name] = $value;
        }
        return $this;
    }

    /**
     * 渲染模板输出
     * @param string $template
     */
    public function display($template = '')
    {
        return $this->fetch($template = '');
    }

    /**
     * 使用指定模板
     * @param string $template
     */
    private function fetch($template = '')
    {
        if(!$template){
            $request = Request::instance();
            $template = APP_PATH;
            if($request->module_name){
                $template .= $request->module_name . DS;
            }
            $template .= 'view' . DS . $request->controller_name . DS . $request->action_name . '.php';
        }

        if(file_exists($template)){
            extract($this->data);
            include_once $template;
        }else{
            Debug::dump('模板文件' . $template . '不存在');
        }
    }
}
