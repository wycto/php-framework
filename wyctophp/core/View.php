<?php
namespace wycto;

class View
{
    public static function run($template=''){
        if($template){
            include_once $template;
        }else{
            $route = App::$route;
            $file = APP_PATH;
            if($route->module_name){
                $file .= $route->module_name . DS;
            }
            $file .= 'view' . DS . $route->controller_name . DS . $route->action_name . '.html';
            include_once $file;
        }
    }
}

?>