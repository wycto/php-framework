<?php
declare (strict_types = 1);

namespace app\index\controller;

/**
 * 控制器基础类
 */
class BaseController
{
    /**
     * Request实例
     * @var \wycto\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \wycto\App
     */
    protected $app;

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;
    }
}
