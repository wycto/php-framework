<?php
namespace wycto;

/**
 *
 * @author WeiYi
 *        
 */
class Loader
{

    /**
     * 注册自动加载机制
     * @access public
     * @param  callable $autoload 自动加载处理方法
     * @return void
     */
    public static function register($autoload = null)
    {
        // 注册系统自动加载
        spl_autoload_register($autoload ?: 'wycto\\Loader::autoload', true, true);
    }
    
    /**
     * 自动加载
     * @access public
     * @param  string $class 类名
     * @return bool
     */
    public static function autoload($class)
    {
        require_once __DIR__ . DS . substr($class,6) . '.php';
    }
}

?>