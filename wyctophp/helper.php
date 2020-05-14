<?php 
use wycto\Debug;
if (!function_exists('dump')) {
    function dump($var)
    {
        return Debug::dump($var);
    }
}
?>