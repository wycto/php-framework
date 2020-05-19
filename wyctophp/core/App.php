<?php
namespace wycto;

class App
{
    static function run(){
        $app_config = Config::get('app');
        $route = new Route();
        $controller_classname = $route->controller_name . $app_config['controller_suffix'];
        $controller_classname = DS . 'app' . DS . 'controller' . DS . ucfirst($controller_classname);
        $controller_classname = str_replace('/','\\',$controller_classname);

        $controller = new $controller_classname();

        if($app_config['use_action_prefix']){
            $action_name = 'action' . ucfirst($route->action_name);
        }else{
            $action_name = $route->action_name . $app_config['action_suffix'];
        }

        if(method_exists($controller,$action_name)){
            $controller->$action_name();
        }else{
            dump('控制器方法：【' . $action_name . '】不存在');
        }
    }
}
