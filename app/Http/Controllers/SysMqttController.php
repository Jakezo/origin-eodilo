<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\FrenchSeat;
use App\Models\FrenchRoom;
use App\Models\FrenchConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Classes\Iot;

class SysMqttController extends Controller
{


    public function __construct(Request $request)
    {


        $this->partner = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchRoom = new FrenchRoom();
        $this->FrenchConfig = new FrenchConfig();
        
        if( !$this->FrenchConfig->cf_iot_base ) {
            return response()->json([
                "result" => false,
                "message" => "관리자에게 문의해주세요. [NO IOT BASE]",
            ]);
        }
        if( !$this->FrenchSeat->s_iot1 ) {
            return response()->json([
                "result" => false,
                "message" => "관리자에게 문의해주세요.  [NO SEAT IOT]",
            ]);
        }        

    }

    // 가맹점관리자가 IOT 컨트롤
    public function ManagerPublish(request $request){

          // 문열기 실행
          $IOT = new IOT();


          $IOT->setPartner($this->partner->p_no);

          $topic = $IOT->FrenchConfig->cf_iot_base . '/' . $request->dev_no;
          $snum = $request->status.$request->iot_no;

          $output = $IOT->PublishNew($topic, $request->dev_no, $request->iot_no, $request->status);
         
          return response($output);

    }

    // 가맹점관리자가 IOT 컨트롤
    public function ManagerPublishStatus(request $request){
        $IotLog = \App\Models\IotLog::find($request->no);
        if( $IotLog ) {
            $return["result"] = true;
            $return["no"] = $IotLog->log_no;
            $return["data"] = $IotLog->log_status;
        } else {
            $return["result"] = false;
            $return["message"] = "해당로그가 없습니다.";
        }
        return response($IotLog->log_status);
    }

    

    // 가맹점관리자가 IOT 컨트롤
    public function ManagerSubscribe(request $request){

          // 문열기 실행
          $IOT = new IOT();
          $IOT->setPartner($this->partner->p_no);

          $topic = $IOT->FrenchConfig->cf_iot_base . '/' . $request->dev_no;

          //$client_id = 0;
          $output = $IOT->Subscribe($topic) ;

          return response($output);

    }


}

