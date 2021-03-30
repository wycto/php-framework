<?php
declare (strict_types = 1);
namespace wycto;

class Controller
{
    protected $request;

    function __construct()
    {
        $this->request = Request::instance();
    }

    function success($msg,$data=''){
        echo json_encode(array('code'=>1,'msg'=>$msg,'data'=>$data));
        exit();
    }

    function error($msg,$data=''){
        echo json_encode(array('code'=>0,'msg'=>$msg,'data'=>$data));
        exit();
    }
}
