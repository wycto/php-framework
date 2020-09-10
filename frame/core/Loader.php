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

    static private $class_map = array();
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
            'wycto' => CORE_PATH,
            'app' => APP_PATH
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
        $first_find = strpos($class,'\\');//获取第一个斜杠的位置
        $root_namespace = substr($class,0,$first_find);//获取根命名空间名
        $root_class_name = substr($class,$first_find+1);//获取除去根命名空间带子命名空间的类

        $last_find = strrpos($class,'\\');//获取最后一个斜杠的位置
        $class_name = substr($class,$last_find+1);//获取除去命名空间的类名

        if(isset(self::$namespace_map[$root_namespace])){//如果在映射里面，返回命名空间地址
            $path = self::$namespace_map[$root_namespace];
        }else{
            $path = '';//没有在映射里面，返回空
        }

        $file = $path . $root_class_name . EXT;
        $file = str_replace('\\',DS , $file);

        if(isset(self::$class_map[$class])){
            return ;
        }else{
            if(file_exists($file)){
                self::$class_map[$class] = $file;
                include $file;
            }else{
                Debug::dump('类' . $class_name . " 文件不存在" . $file);
            }
        }
    }
}
