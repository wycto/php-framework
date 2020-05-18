<?php
namespace wycto;
class Route
{
    public $module_name ='index';

    public $controller_name ='index';

    public $action_name = 'index';

    public $mca = array();

    public $many_app = false;

    function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri_array = explode('/',trim($uri,'/'));
        if($this->many_app){
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
            if(isset($uri_array[0])){
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
}

