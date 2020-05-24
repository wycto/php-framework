<?php

return [
    'app' => [
        // 应用调试模式
        'debug' => false,
        // 是否多应用
        'multi_module'       => true,
        // 默认时区
        'default_timezone'       => 'PRC',
        // 控制器类后缀
        'controller_suffix'      => 'Controller',
        // 默认模块名
        'default_module'         => 'index',
        // 禁止访问模块
        'deny_module_list'       => ['common'],
        // 默认控制器名
        'default_controller'     => 'index',
        // 默认操作名
        'default_action'         => 'index',
        // 默认的空控制器名
        'empty_controller'       => 'Error',
        // 操作方法前缀
        'use_action_prefix'      => false,
        // 操作方法后缀
        'action_suffix'          => 'Action',
        //过滤器
        'default_filter' => ''
    ],
    'log'                    => [
        // 日志记录方式
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],
    //缓存设置
    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],
    //会话设置
    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
        'httponly'       => true,
        'secure'         => false,
    ],
    //Cookie设置
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],
    //数据库设置
    'database'               => [
        // 数据库类型
        'type'            => 'mysql',
        // 数据库连接DSN配置
        'dsn'             => '',
        // 服务器地址
        'hostname'        => '127.0.0.1',
        // 数据库名
        'database'        => '',
        // 数据库用户名
        'username'        => 'root',
        // 数据库密码
        'password'        => '',
        // 数据库连接端口
        'hostport'        => '',
        // 数据库编码默认采用utf8
        'charset'         => 'utf8',
        // 数据库表前缀
        'prefix'          => '',
    ]
];
