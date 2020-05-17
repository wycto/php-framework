<?php
/*
 * 1.定义常量
 * 2.引入函数库
 * 3.自动加载
 * 4.错误注册
 * 5.配置加载
 * 6.启动框架
 * 7.路由解析
 * 8.加载控制器
 * 9.返回结果
 * */
require_once __DIR__ . '/../wyctophp/start.php';

//启用框架
\wycto\App::run();

dump('WYCTO_PATH : ' . WYCTO_PATH);
dump('APP_PATH: ' . APP_PATH);
dump('ROOT_PATH: ' . ROOT_PATH);
dump($_SERVER['SCRIPT_FILENAME']);