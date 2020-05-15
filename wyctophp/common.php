<?php
function mydump($var)
{
    if(is_bool($var)||is_null($var)){
        var_dump($var);
    }else{
        echo "<pre style='border: 1px solid #ccc;padding: 20px;font-size: 1.2em'>" . print_r($var,true) . "</pre>";
    }
}