<?php
namespace wycto;

class Session
{

    function __construct()
    {}

    function set($key,$val){
        $_SESSION[$key] = $val;
    }

    function get($key){
        return isset($_SESSION[$key])?$_SESSION[$key]:"";
    }
}
