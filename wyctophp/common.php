<?php
function mydump($var)
{
    if(is_bool($var)||is_null($var)){
        var_dump($var);
    }else{
        echo "<pre>" . print_r($var,true) . "</pre>";
    }
}