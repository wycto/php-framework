<?php
namespace wycto;

class App
{
    static function run(){
       $route = new  Route();
       $controller_name = $route->controller_name . 'Controller';
       $controller_name = DS . 'app' . DS . 'controller' . DS . ucfirst($controller_name);
       $controller_name = str_replace('/','\\',$controller_name);
       $controller = new $controller_name();

        $action_name = $route->action_name . 'Action';
        if(method_exists($controller,$action_name)){
            $controller->$action_name();
        }else{
            dump('方法：【' . $action_name . '】不存在');
        }
    }
}
