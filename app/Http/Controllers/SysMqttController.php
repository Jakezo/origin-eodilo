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

          $message = "{snum:'".$snum."', id:'1'}";  
          $client_id = 0;
          $output = $IOT->Publish($topic, $message, $client_id) ;

          return response($output);

    }


}

