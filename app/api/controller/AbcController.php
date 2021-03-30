<?php


namespace app\api\controller;

use wycto\Controller;
use wycto\Db;
use wycto\Log;

class AbcController extends Controller
{
    function indexAction(){

    }

    //交易
    function payToAccountAction(){

        $code = $this->request->param("payAccountNumber");
        $code = explode("-",$code);
        $code = $code[1];

        $to_code = $this->request->param("receiveAccountNumber");
        $to_code = explode("-",$to_code);
        $to_code = $to_code[1];

        $money = $this->request->param("amount");
        $memo = $this->request->param("orderDesc");
        $trans_no = $this->request->param("ReqSeqNo");

        $data = [
            "code"=>$code,
            "to_code"=>$to_code,
            "money"=>$money,
            "memo"=>$memo,
            "trans_no"=>$trans_no,
            "date_time"=>date("Y-m-d H:i:s")
        ];

        //查账号是否存在
        $account1 = Db::table("account")->where(['code'=>$code])->getOne();
        if(empty($account1)){
            $result = array(
                "errCode"=>"0",
                "obj" => array(
                    "respCode"=>"2001",
                    "reqSeqNo"=>date("YmdHis"),
                    "err_Inf"=>"账号【".$code."】不存在"
                )
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit();
        }

        $account2 = Db::table("account")->where(['code'=>$to_code])->getOne();
        Log::addErrorLog(Db::connect()->getLastSql());
        if(empty($account2)){
            $result = array(
                "errCode"=>"0",
                "obj" => array(
                    "respCode"=>"2001",
                    "reqSeqNo"=>date("YmdHis"),
                    "err_Inf"=>"账号【".$to_code."】不存在"
                )
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit();
        }

        $result = Db::table("account_trans")->insert($data);
        Log::addErrorLog($data);
        if($result){
            //金额修改
            Db::table("account")->update(['money'=>bcsub($account1['money'],$money,2)],['code'=>$code]);
            Db::table("account")->update(['money'=>bcadd($account2['money'],$money,2)],['code'=>$to_code]);
            $result = array(
                "errCode"=>"0",
                "obj" => array(
                    "respCode"=>"0000",
                    "reqSeqNo"=>date("YmdHis"),
                    "err_Inf"=>""
                )
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit();
        }else{
            $result = array(
                "errCode"=>"0",
                "obj" => array(
                    "respCode"=>"2002",
                    "reqSeqNo"=>date("YmdHis"),
                    "err_Inf"=>""
                )
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    //开户、销户、查询账簿账号
    function queryAccountBookBalanceAction(){
        $BankAccountNum = $this->request->param("DbAccNo");
        $AccountNum = $this->request->param("DbLogAccNo");
        $AccountName = $this->request->param("DbLogAccName");
        $SysBankAppID = $this->request->param("appId");
        $bankType = $this->request->param("bankType");
        $version = $this->request->param("version");

        $bankAccountNumber = $this->request->param("bankAccountNumber");

        if($bankAccountNumber){
            $bankAccountNumber = explode("-",$bankAccountNumber);
            $bankAccountNumber = isset($bankAccountNumber[1])?$bankAccountNumber[1]:$bankAccountNumber[0];
            $balance = Db::table("account")->where(['code'=>$bankAccountNumber])->getOne();
            Log::addErrorLog(Db::connect()->getLastSql());
            Log::addErrorLog($balance);
            if($balance){
                $result = array(
                    "success" => true,
                    "msg" => "",
                    "code" => "success",
                    "errCode"=>"0",
                    "obj" => array(
                        "respCode"=>"0000",
                        "reqSeqNo"=>date("YmdHis"),
                        "err_Inf"=>"",
                        "balance"=>$balance["money"]
                    )
                );
            }else{
                $result = array(
                    "success" => true,
                    "msg" => "",
                    "code" => "success",
                    "errCode"=>"0",
                    "obj" => array(
                        "respCode"=>"1001",
                        "reqSeqNo"=>date("YmdHis"),
                        "err_Inf"=>"",
                        "balance"=>0
                    )
                );
            }

            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit();
        }

        if($AccountName){
            //开户
            if(Db::table("account")->where(['code'=>$AccountNum])->getOne()){
                $result['ap']['RespCode'] = "0000";
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
                exit();
            }

            $data = [
                "name"=>$AccountName,
                "code"=>$AccountNum,
                "date_time"=>date("Y-m-d H:i:s"),
                "status"=>1,
                "money"=>"0.00"
            ];

            $re = Db::table("account")->insert($data);
            if($re){
                $result['ap']['RespCode'] = "0000";
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
                exit();
            }
        }

        $result = array(
            "ap" => array(
                "RespCode"=>"0000",
                "RespInfo"=>""
            )
        );

        if(Db::table("account")->where(['code'=>$AccountNum])->getOne()){
            $result['ap']['RespCode'] = 2002;
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit();
        }

        $data = [
            "name"=>$AccountName,
            "code"=>$AccountNum,
            "datetime"=>date("YmdHis")
        ];

        $res= Db::table("account")->insert($data);
        if($res){
            $result['ap']['RespCode'] = 2003;
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit();
        }

        $result['ap']['RespCode'] = "0000";
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
    }

    //查询主账户
    function queryAccountBalanceAction(){
        $result = array(
            "success" => true,
            "msg" => "",
            "code" => "success",
            "errCode"=>"0",
            "obj" => array(
                "respCode"=>"0000",
                "reqSeqNo"=>date("YmdHis"),
                "err_Inf"=>"",
                "balance"=>10000
            )
        );

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
    }
}