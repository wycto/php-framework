<?php
namespace wycto;
class Route
{
    function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri_array = explode('/',trim($uri,'/'));
        dump($uri_array);
    }
}

?>