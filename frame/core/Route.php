<?php
namespace wycto;
class Route
{
    private static $module_name;

    private static $controller_name;

    private static $action_name;

    private static $mca = array();

    private static $multi_module;

    private static $app_config;

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

    public static function  parse($request, $config){
        $app_config = $config['app'];

        self::$module_name = $app_config['default_module'];
        self::$controller_name = $app_config['default_controller'];
        self::$action_name = $app_config['default_action'];
        self::$multi_module = $app_config['multi_module'];
        self::$app_config = $app_config;

        $uri = $request->request_url;
        $uri_array = explode('/',trim($uri,'/'));
        if(self::$multi_module){
            //多应用
            if($uri_array[0]){
                self::$module_name = $uri_array[0];//模块名称
            }
            if(isset($uri_array[1])){
                self::$controller_name = $uri_array[1];//控制器名称
            }
            if(isset($uri_array[2])){
                self::$action_name = $uri_array[2];//方法名称
            }
            //参数部分
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
            self::$module_name = '';//模块名称

            if($uri_array[0]){
                self::$controller_name = $uri_array[0];//控制器名称
            }
            if(isset($uri_array[1])){
                self::$action_name = $uri_array[1];//方法名称
            }

            //参数部分
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

        self::$mca['module_name'] = self::$module_name;
        self::$mca['controller_name'] = self::$controller_name;
        self::$mca['action_name'] = self::$action_name;

        return array(
            "type" => "module",
            "module" => array(
                'module_name' => self::$module_name,
                'controller_name' => self::$controller_name,
                'action_name' => self::$action_name
            )
        );
    }
}

