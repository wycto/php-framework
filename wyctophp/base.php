<?php

use wycto\Debug;
define('WYCTO_VERSION', '0.0.1');
define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);
define('WYCTO_PATH', __DIR__ . DS);
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . DS);
defined('ROOT_PATH') or define('ROOT_PATH', dirname(realpath(APP_PATH)) . DS);
defined('RUNTMP_PATH') or define('RUNTMP_PATH', ROOT_PATH . 'runtmp' . DS);
defined('LOG_PATH') or define('LOG_PATH', RUNTMP_PATH . 'log' . DS);
defined('CACHE_PATH') or define('CACHE_PATH', RUNTMP_PATH . 'cache' . DS);
defined('TEMP_PATH') or define('TEMP_PATH', RUNTMP_PATH . 'temp' . DS);
defined('CONF_PATH') or define('CONF_PATH', APP_PATH); // 配置文件目录
defined('CONF_EXT') or define('CONF_EXT', EXT); // 配置文件后缀

require_once 'common.php';
require_once 'Loader.php';
// 注册自动加载
\wycto\Loader::register();
mydump(WYCTO_VERSION);
