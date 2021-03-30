<?php
return [
    // 应用调试模式
    'debug' => false,
    //error_reporting错误级别
    'error_reporting' => 0,
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
    //过滤器,填写过滤函数名称，多个用英文逗号分隔
    'default_filter' => ''
];
