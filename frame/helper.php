<?php 
if (!function_exists('view')) {
    function view($template='')
    {
        return \wycto\View::instance()->display($template='');
    }
}