<?php

namespace App\Http\Controllers\Iot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\IotLog;

class IotLogController extends Controller
{
    public function __construct()
    {

    }

    public function input(Request $request)
    {
        $result = [];
        $IotLog = new \App\Models\IotLog();

        if( $request->data ) {
  
            $IotLog->log_partner = $request->partner ?? 0;
            $data = json_decode($request->data);

            if( isset($data->id ) ) {
                $IotLog = \App\Models\IotLog::find((int)$data->id);
                $IotLog->log_data = $request->data ?? "";
                if( $data->Smod ) $IotLog->log_status = $data->Smod;
                //else $IotLog->log_status = "";

                if( $IotLog->update() ) {
                    $result['result'] = true;
                    $result['message'] = "OK";
                } else {
                    $result['result'] = false;
                    $result['message'] = "NOT SAVED";
                }

            } else {
                $IotLog = new \App\Models\IotLog();
                $IotLog->log_data = $request->data;

                if( $IotLog->save() ) {
                    $result['result'] = true;
                    $result['message'] = "OK";
                } else {
                    $result['result'] = false;
                    $result['message'] = "NOT SAVED";
                }
            }


        } else {
            $result['result'] = false;
            $result['message'] = "NO DATA";
        }

        return response($result);

        // // 무조건 저장.
        // $IotLog->log_data = $request->data;
        // if( $IotLog->log_data ) {
        //     if( $IotLog->log_no ) {
        //         if( $IotLog->update() ) {
        //             $result['result'] = true;
        //             $result['message'] = "OK";
        //         }
        //     } else {
        //         if( $IotLog->save() ) {
        //             $result['result'] = true;
        //             $result['message'] = "OK";
        //         }
        //     }
        // } else {
        //     $result['result'] = false;
        //     $result['message'] = "NOT SAVED";
        // }
        // return response($result);
    }

    // 테스트를 위해 사용함. 
    public function form(Request $request)
    {

            //post body Data
            $post = [
                "a" => "aaa",
                "b" => "bbb",
                "c" => "ccc",
            ];

            // $headers[] = 'X-IB-Client-Id: 발급받은ID';
            // $headers[] = 'X-IB-Client-Passwd: 발급받은PASSWD';
            // $headers[] = 'Content-Type: application/json;charset=UTF-8';
            // $headers[] = 'Authorization: bearer 인증키';
            $headers[] = 'Accept: application/json';

            $ch = curl_init("http://admin.eodilo.com/api/iotlog");

            // SSL important
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);        
            curl_setopt($ch, CURLOPT_POST, 1);                              //post
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));       //파라미터 값
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                    //return 값 반환 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                 //헤더
            curl_setopt($ch, CURLOPT_VERBOSE, true);                        //디버깅
            //curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);               //데이터 전달 형태
            //curl_setopt($ch, CURLOPT_COOKIE, 'token= ***** ');            //로그인 인증

            $output = curl_exec($ch);

            dd($output);        

    }
}
