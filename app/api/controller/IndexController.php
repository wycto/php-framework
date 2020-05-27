<?php


namespace app\api\controller;


use wycto\Request;

class IndexController
{
    function indexAction(){

    }

    /**
     * 河南监狱的罪犯基本信息
     */
    function prisonerHeNanAction(){

        $request = Request::instance();
        if($request->isPost()){
            $format = $request->param('format','json');
            $appid = $request->post('appid');
            if($appid!='xcjyzgxt'){
                echo json_encode(array(
                    "success" => false,
                    "msg" => 'appid error',
                    "code" => "fail",
                ));
                exit();
            }
            $result = array(
                "success" => true,
                "msg" => null,
                "code" => "success",
                "data" => array(
                    array(
                        "dwbh" => "4123",
                        "zf_bh" => "41234566123",
                        "xm" => "张三",
                        "lrsj" => "2013-10-24t11:39:00.000+08:00",
                        "xb" => 1,
                        "cym" => "张小三",
                        "zjlx" => "身份证",
                        "zjhm" => "111111111111",
                        "csrq" => "2004-05-03",
                        "mz" => "汉族",
                        "zfzp" => "/archives/photo/1121048777.jpg",
                        "hjmx" => "xx省xx市xx街道",
                        "jtmx" => "xx省xx市xx街道",
                        "jqbh" => "3",
                        "jqmx" => "一监区一分监区",
                        "ljlb" => "",
                        "cydjbh" => 1,
                        "cydjmc" => "严管级",
                        "ljrq" => null,
                        "rjrq" => "2004-05-03",
                        "zt" => 1,
                        "zmmc" => "绑架、敲诈勒索",
                        "xq" => "170600",
                        "fylx" => "财产型"
                    ),
                    array(
                        "dwbh" => "4123",
                        "zf_bh" => "41234566123",
                        "xm" => "张三",
                        "lrsj" => "2013-10-24t11:39:00.000+08:00",
                        "xb" => 1,
                        "cym" => "张小三",
                        "zjlx" => "身份证",
                        "zjhm" => "111111111111",
                        "csrq" => "2004-05-03",
                        "mz" => "汉族",
                        "zfzp" => "/archives/photo/1121048777.jpg",
                        "hjmx" => "xx省xx市xx街道",
                        "jtmx" => "xx省xx市xx街道",
                        "jqbh" => "3",
                        "jqmx" => "一监区一分监区",
                        "ljlb" => "",
                        "cydjbh" => 1,
                        "cydjmc" => "严管级",
                        "ljrq" => null,
                        "rjrq" => "2004-05-03",
                        "zt" => 1,
                        "zmmc" => "绑架、敲诈勒索",
                        "xq" => "170600",
                        "fylx" => "财产型"
                    ),
                    array(
                        "dwbh" => "4123",
                        "zf_bh" => "41234566123",
                        "xm" => "张三",
                        "lrsj" => "2013-10-24t11:39:00.000+08:00",
                        "xb" => 1,
                        "cym" => "张小三",
                        "zjlx" => "身份证",
                        "zjhm" => "111111111111",
                        "csrq" => "2004-05-03",
                        "mz" => "汉族",
                        "zfzp" => "/archives/photo/1121048777.jpg",
                        "hjmx" => "xx省xx市xx街道",
                        "jtmx" => "xx省xx市xx街道",
                        "jqbh" => "3",
                        "jqmx" => "一监区一分监区",
                        "ljlb" => "",
                        "cydjbh" => 1,
                        "cydjmc" => "严管级",
                        "ljrq" => null,
                        "rjrq" => "2004-05-03",
                        "zt" => 1,
                        "zmmc" => "绑架、敲诈勒索",
                        "xq" => "170600",
                        "fylx" => "财产型"
                    )
                )
            );

            if($format=='json'){
                echo json_encode($result);
            }else{
                dump($result);
            }
            exit();
        }
    }
}