<?php
namespace wycto;

/**
 *
 * @author WeiYi
 *        
 */
class Error
{
    /**
     * 注册异常处理
     * @access public
     * @return void
     */
    public static function register()
    {
        $config_app = Config::get('app');
        if($config_app['debug']){
            error_reporting(E_ALL);
        }else{
            error_reporting(0);
        }

        /*set_error_handler([__CLASS__, 'appError']);
        set_exception_handler([__CLASS__, 'appException']);
        register_shutdown_function([__CLASS__, 'appShutdown']);*/
        register_shutdown_function([__CLASS__, 'appShutdown']);
    }

    static function appShutdown(){
        $Error = error_get_last();
        if(!is_null($Error)){
            //$ErrorText = json_encode($Error);
            $config_app = Config::get('app');
            if($config_app['debug']){
                dump($Error);
            }else{
                dump($Error);
            }
        }
    }
}
