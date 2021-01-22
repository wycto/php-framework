# 欢迎使用 wycto打造的轻量级PHP框架

**众所周知：框架是减轻工作量的工具，避免重复造轮子，利用框架结合优秀的开发思想，能让我们的快速上手、便于阅读、易于维护，事半功倍**

------------




## 框架思想：MVC，既M（模型）、V（视图）、C（控制器）
- C（控制器）：请求响应处理，网址访问的地方；负责接收请求参数，调度模型或者其他方处理业务逻辑

- M（模型）：数据库调度（调用数据库类操作数据）、业务处理（被控制器调度）

- V（视图）：html页面（html+js+css）看得见的页面展示



------------



## 框架目录结构

    www  WEB部署目录（或者子目录）
    ├─app           应用目录
    │  ├─admin      后台管理应用
    │  ├─api        api应用
    │  ├─common     公共应用
    │  ├─index      前台网站应用
    │  │  ├─controller       控制器文件夹
    │  │  ├─model            模型文件夹
    │  │  ├─view             视图文件夹
    │  ├─wap        微网站应用
    │  ├─common.php         公共函数文件
    │
    ├─config                配置目录
    │  ├─app.php            应用配置
    │  ├─cookie.php         Cookie配置
    │  ├─database.php       数据库配置
    │  ├─log.php            日志配置
    │  └─view.php           视图配置
    │
    ├─frame                 框架目录
    ├─public                WEB目录（对外访问目录）
    │  ├─static             静态资源目录（存放js、css、img）
    │  ├─index.php          入口文件
    │  └─.htaccess          用于apache的重写
    ├─vendor                Composer类库目录
    ├─composer.json         composer 定义文件
    ├─README.md             README 文件





## 部署

入口文件在public下面，域名访问 public 下面的 index.php 入口文件

- 配置好apache或者nginx的重写模式

## 配置
### 应用配置 app.php
```php
<?php
return [
    // 应用调试模式
    'debug' => true,
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

```

### 数据库配置 database.php

    <?php
    return [
        // 数据库类型
        'type'            => 'mysql',
        // 数据库连接DSN配置
        'dsn'             => '',
        // 服务器地址
        'hostname'        => '127.0.0.1',
        // 数据库名
        'database'        => 'qiheqihui',
        // 数据库用户名
        'username'        => 'root',
        // 数据库密码
        'password'        => 'root',
        // 数据库连接端口
        'hostport'        => '',
        // 数据库编码默认采用utf8
        'charset'         => 'utf8',
        // 数据库表前缀
        'prefix'          => 'cto_',
        //是否持久化
        'persistent' => true
    ];


#待续......