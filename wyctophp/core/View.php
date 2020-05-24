<?php
namespace wycto;

class View
{
    public static function run($template=''){
        if($template){
            include_once $template;
        }else{
            $request = Request::instance();
            $file = APP_PATH;
            if($request->module_name){
                $file .= $request->module_name . DS;
            }
            $file .= 'view' . DS . $request->controller_name . DS . $request->action_name . '.html';
            include_once $file;
        }
    }

    public static function load($file=''){
        if($file){
            include_once $file;
        }else{
            $request = Request::instance();
            $file = APP_PATH;
            if($request->module_name){
                $file .= $request->module_name . DS;
            }
            $file .= 'view' . DS . $request->controller_name . DS . $request->action_name . '.html';
            include_once $file;
        }
    }
}
