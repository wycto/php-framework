<?php
namespace wycto;

class App
{
    /**
     * @var array 请求调度分发
     */
    protected static $dispatch;

    static function run(){

        //获取配置
        $config = Config::get();

        //请求处理
        $request = Request::instance(['config'=>$config]);

        //路由调度
        $dispatch = self::$dispatch;
        if (empty($dispatch)) {
            $dispatch = Route::parse($request, $config);
        }

        //赋值调度
        $request->dispatch($dispatch);

        //调度执行
        $res = $request->execute();

        //响应输出
        Response::instance()->send($res);
    }
}
