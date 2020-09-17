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
            echo "<pre style='white-space: pre-wrap;border: 1px solid indianred;padding: 20px;font-size: 1.2em;background-color: #ddd;color: darkred;line-height: 1.5em'>" . print_r($var,true) . "</pre>";
        }
    }

    public static function halt($var)
    {
        Debug::dump($var);
        exit();
    }
}
