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

            $app_file = ROOT_PATH . 'config'  . DS . 'app.php';
            if(file_exists($app_file)){
                $app_config = require_once($app_file);
                if(count($app_config)){
                    $config = array_merge($config, ['app'=>$app_config]);
                }
            }

            $database_file = ROOT_PATH . 'config'  . DS . 'database.php';
            if(file_exists($database_file)){
                $database_config = require_once($database_file);
                if(count($database_config)){
                    $config = array_merge($config, ['database'=>$database_config]);
                }
            }

            $log_file = ROOT_PATH . 'config'  . DS . 'log.php';
            if(file_exists($log_file)){
                $log_config = require_once($log_file);
                if(count($log_config)){
                    $config = array_merge($config, ['log'=>$log_config]);
                }
            }

            $cache_file = ROOT_PATH . 'config'  . DS . 'cache.php';
            if(file_exists($log_file)){
                $cache_config = require_once($cache_file);
                if(count($cache_config)){
                    $config = array_merge($config, ['cache'=>$cache_config]);
                }
            }

            $session_file = ROOT_PATH . 'config'  . DS . 'session.php';
            if(file_exists($session_file)){
                $session_config = require_once($session_file);
                if(count($session_config)){
                    $config = array_merge($config, ['session'=>$session_config]);
                }
            }

            $cookie_file = ROOT_PATH . 'config'  . DS . 'cookie.php';
            if(file_exists($cookie_file)){
                $cookie_config = require_once($cookie_file);
                if(count($cookie_config)){
                    $config = array_merge($config, ['cookie'=>$cookie_config]);
                }
            }

            return self::$config[$range] = $config;
        }
    }

    /**
     * 获取配置
     * @param null $name
     * @param string $range
     * @return mixed|null
     */
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
