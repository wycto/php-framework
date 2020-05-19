<?php 
if (!function_exists('view')) {
    function view($template='')
    {
        return \wycto\View::run($template='');
    }
}
?>