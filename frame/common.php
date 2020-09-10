<?php
function dump($var)
{
    if(is_bool($var)||is_null($var)){
        var_dump($var);
    }else{
        echo "<pre style='white-space: pre-wrap;border: 1px solid #aaa;padding: 20px;font-size: 1.2em;background-color: #bbb;color: #000;line-height: 1.5em'>" . print_r($var,true) . "</pre>";
    }
}
function halt($var)
{
    dump($var);
    exit();
}
