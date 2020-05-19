<?php
namespace wycto;
class Route
{
    public $module_name;

    public $controller_name;

    public $action_name;

    public $mca = array();

    public $multi_module;

    public $app_config;

    function __construct()
    {
        $app_config = Config::get('app');
        $this->module_name = $app_config['default_module'];
        $this->controller_name = $app_config['default_controller'];
        $this->action_name = $app_config['default_action'];
        $this->multi_module = $app_config['multi_module'];
        $this->app_config = $app_config;

        $uri = $_SERVER['REQUEST_URI'];
        $uri_array = explode('/',trim($uri,'/'));
        if($this->multi_module){
            //多应用
            if($uri_array[0]){
                $this->module_name = $uri_array[0];
            }
            if(isset($uri_array[1])){
                $this->controller_name = $uri_array[1];
            }
            if(isset($uri_array[2])){
                $this->action_name = $uri_array[2];
            }
            //参数
            if(count($uri_array)>3){
                for ($i=3;$i<=count($uri_array);){
                    if(isset($uri_array[$i])){
                        $_GET[$uri_array[$i]] = isset($uri_array[$i+1])?$uri_array[$i+1]:null;
                        $_REQUEST[$uri_array[$i]] = isset($uri_array[$i+1])?$uri_array[$i+1]:null;
                    }
                    $i += 2;
                }
            }
        }else{
            //单应用
            $this->module_name = '';

            if($uri_array[0]){
                $this->controller_name = $uri_array[0];
            }
            if(isset($uri_array[1])){
                $this->action_name = $uri_array[1];
            }
            //参数
            if(count($uri_array)>2){
                for ($i=2;$i<=count($uri_array);){
                    if(isset($uri_array[$i])){
                        $_GET[$uri_array[$i]] = isset($uri_array[$i+1])?$uri_array[$i+1]:null;
                        $_REQUEST[$uri_array[$i]] = isset($uri_array[$i+1])?$uri_array[$i+1]:null;
                    }
                    $i += 2;
                }
            }
        }

        $this->mca['module_name'] = $this->module_name;
        $this->mca['controller_name'] = $this->controller_name;
        $this->mca['action_name'] = $this->action_name;
    }

    function start(){
        $controller_classname = $this->controller_name . $this->app_config['controller_suffix'];
        if($this->multi_module){
            if(!is_dir(ROOT_PATH . 'app' . DS . $this->module_name)){
                halt('模块：【' . $this->module_name . '】不存在');
            }
            $controller_classname = DS . 'app' . DS . $this->module_name . DS . 'controller' . DS . ucfirst($controller_classname);
        }else{
            $controller_classname = DS . 'app' . DS . 'controller' . DS . ucfirst($controller_classname);
        }

        $controller_classname = str_replace('/','\\',$controller_classname);

        $controller = new $controller_classname();

        if($this->app_config['use_action_prefix']){
            $action_name = 'action' . ucfirst($this->action_name);
        }else{
            $action_name = $this->action_name . $this->app_config['action_suffix'];
        }

        if(method_exists($controller,$action_name)){
            $controller->$action_name();
        }else{
            halt('控制器方法：【' . $action_name . '】不存在');
        }
    }
}

