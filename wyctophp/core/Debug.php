<?php
namespace wycto;

/**
 *
 * @author WeiYi
 *        
 */
class Debug
{

    public static function dump($var)
    {
        if(is_bool($var)||is_null($var)){
            var_dump($var);
        }else{
            echo "<pre>" . print_r($var,true) . "</pre>";
        }
    }
}
