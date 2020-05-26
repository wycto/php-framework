<?php
define('WYCTO_VERSION', '0.0.1');
define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);
define('WYCTO_PATH', __DIR__ . DS);
define('CORE_PATH', WYCTO_PATH . 'core' . DS);
defined('ROOT_PATH') or define('ROOT_PATH', realpath(dirname(__DIR__ . DS)) . DS);//跟目录
defined('PUBLIC_PATH') or define('PUBLIC_PATH', ROOT_PATH . 'public' .DS);// app文件目录
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . 'app' .DS);// app文件目录
defined('CONFIG_PATH') or define('CONFIG_PATH', ROOT_PATH . 'config' . DS); // 配置文件目录
defined('CONFIG_EXT') or define('CONFIG_EXT', EXT); // 配置文件后缀
defined('RUNTIME_PATH') or define('RUNTIME_PATH', ROOT_PATH . 'runtime' . DS);
defined('LOG_PATH') or define('LOG_PATH', RUNTIME_PATH . 'log' . DS);
defined('CACHE_PATH') or define('CACHE_PATH', RUNTIME_PATH . 'cache' . DS);
defined('TEMP_PATH') or define('TEMP_PATH', RUNTIME_PATH . 'temp' . DS);

require_once 'common.php';
require_once 'core' . DS . 'Loader.php';
require_once 'helper.php';

// 注册自动加载
\wycto\Loader::register();

//配置注册
\wycto\Config::register();

//错误和异常注册
\wycto\Error::register();
