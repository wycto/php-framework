<?php
namespace wycto;

class App
{
    static $route;
    static function run(){
        $route = new Route();
        self::$route = $route;
        $route->start();
    }
}
