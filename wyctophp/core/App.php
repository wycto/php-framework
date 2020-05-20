<?php
namespace wycto;

class App
{
    static $route;
    static function run(){
        $request = Request::instance();
        $route = new Route();
        self::$route = $route;
        $route->start();
        View::load();
    }
}
