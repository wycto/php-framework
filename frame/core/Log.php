<?php
namespace wycto;

/**
 *
 * @author WeiYi
 *        
 */
class Log
{

    /**
     */
    function __construct()
    {}

    /**
     */
    function __destruct()
    {}

    static function addErrorLog($Log, $LogTrace=true){

        if(!is_dir(ROOT_PATH.'/log/')){
            mkdir(ROOT_PATH.'/log/');
        }

        if(is_array($Log)){
            $Log = json_encode($Log,JSON_UNESCAPED_UNICODE);
        }

        $FileName = ROOT_PATH.'/log/error'.date("Ymd").'.log';

        error_log('['.date('Y-m-d H:i:s').'] '.$Log."\r\n",3,$FileName);

        if($LogTrace) {
            //打印堆栈信息
            $TraceArr = debug_backtrace();
            unset($TraceArr[0]);
            $TraceInfo = '';
            foreach($TraceArr as $Key=>$Value) {
                $TraceInfo .= $Value['file'].':'.$Value['line'].'行，调用方法:'.$Value['function']."\r\n";
            }
            error_log('['.date('Y-m-d H:i:s').'] '.'堆栈信息：\r\n'.$TraceInfo."\r\n\r\n",3,$FileName);
        }
    }
}
