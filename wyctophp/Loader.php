<?php
namespace wycto;

/**
 *
 * @author WeiYi
 *        
 */
class Loader
{

    static private $namespace_map = array();
    /**
     * 注册自动加载机制
     * @access public
     * @param  callable $autoload 自动加载处理方法
     * @return void
     */
    public static function register($autoload = null)
    {
        //映射命名空间
        self::$namespace_map = array(
            'wycto' => WYCTO_PATH,
            'app' => APP_PATH,
            'app\controller' => APP_PATH  . 'controller' . DS,
            'app\model' => APP_PATH  . 'model' . DS,
            'app\view' => APP_PATH  . 'view' . DS
        );

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
        $lastfind = strrpos($class,'\\');//获取最后一个斜杠的位置
        $namespace_name = substr($class,0,$lastfind);//获取命名空间名
        $class_name = substr($class,$lastfind+1);//获取命名空间名

        if(isset(self::$namespace_map[$namespace_name])){//如果在映射里面，返回命名空间地址
            $path = self::$namespace_map[$namespace_name];
        }else{
            $path = '';//没有在映射里面，返回空
        }

        $file = $path . $class_name . EXT;
        if(file_exists($file)){
            include $file;
        }else{
            dump("文件不存在" . $file);
        }
    }
}
