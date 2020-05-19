<?php
namespace wycto;

class Config
{
    /**
     * @var array 配置参数
     */
    private static $config = [];

    /**
     * @var string 参数作用域
     */
    private static $range = 'wycto';

    /**
     * 注册配置
     * @param $config_file_path
     */
    public static function register()
    {
        $range = self::$range;
        if (isset(self::$config[$range])){
            return self::$config[$range];
        }else{
            $config = require_once(WYCTO_PATH . 'config.php');
            return self::$config[$range] = $config;
        }
    }

    public static function get($name = null, $range = ''){
        $range = $range ?: self::$range;

        // 无参数时获取所有
        if (empty($name) && isset(self::$config[$range])) {
            return self::$config[$range];
        }

        // 非二级配置时直接返回
        if (!strpos($name, '.')) {
            $name = strtolower($name);
            return isset(self::$config[$range][$name]) ? self::$config[$range][$name] : null;
        }

        // 二维数组设置和获取支持
        $name    = explode('.', $name, 2);
        $name[0] = strtolower($name[0]);

        if (isset(self::$config[$range][$name[0]])) {
            if (isset(self::$config[$range][$name[0]][$name[1]])) {
                return self::$config[$range][$name[0]][$name[1]];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}
