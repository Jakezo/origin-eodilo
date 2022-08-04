<?php

namespace App\Http\Classes;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\FrenchSeat;
use App\Models\FrenchRoom;
use App\Models\FrenchConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
//use PhpMqtt\Client\Facades\MQTT;

use Salman\Mqtt\MqttClass\Mqtt;
use App\Models\IotLog;

if( !class_exists("IOT") ) {

    CLASS IOT{


        public function __construct($p_no="")
        {
            $this->partner = new Partner();
            $this->FrenchSeat = new FrenchSeat();
            $this->FrenchRoom = new FrenchRoom();

            if( $p_no ) {
                $this->setPartner($p_no);
            }
        }

        public function setPartner($p_no){
            $this->partner = Partner::find($p_no);
            Config::set('database.connections.partner.database', "boss_" . $this->partner->p_id);
            $this->FrenchConfig = FrenchConfig::first();
        }


        public function Publish($topic, $message, $client_id){
            $mqtt = new Mqtt();
            $output = $mqtt->ConnectAndPublish($topic, $message, $client_id);
            return $output;
        }

        public function PublishNew($topic, $dev, $iot, $status){
            $mqtt = new Mqtt();

            $topic = $this->FrenchConfig->cf_iot_base . '/' . $dev;
            $snum = $status.$iot;
    
            // 이때 우리 쪽 요청정보를 등록하고 ID 값을 사용한다.
            $IotLog = new \App\Models\IotLog();         
            $IotLog->log_partner = 0;      
            $IotLog->log_base = $this->FrenchConfig->cf_iot_base;    
            $IotLog->log_dev = $dev;      
            $IotLog->log_iot = $iot;      
            $IotLog->log_request = $status;     
            $IotLog->save();

            // 메세지에 id 를 적용한다.
            $client_id = $IotLog->log_no;
            $message = "{service:'EODILO', snum:'".$snum."', id:'".$IotLog->log_no."'}";  
           
            $return["result"] = $mqtt->ConnectAndPublish($topic, $message, $client_id);
            $return["log"] = $IotLog;
            return $return;
        }

        // 2022.08.04 최종..
        public function PublishGo($dev, $iot, $status){
            $mqtt = new Mqtt();

            $topic = $this->FrenchConfig->cf_iot_base . '/' . $dev;
            $snum = $status.$iot;
    
            // 이때 우리 쪽 요청정보를 등록하고 ID 값을 사용한다.
            $IotLog = new \App\Models\IotLog();         
            $IotLog->log_partner = 0;      
            $IotLog->log_base = $this->FrenchConfig->cf_iot_base;    
            $IotLog->log_dev = $dev;      
            $IotLog->log_iot = $iot;      
            $IotLog->log_request = $status;     
            $IotLog->save();

            // 메세지에 id 를 적용한다.
            $client_id = $IotLog->log_no;
            $message = "{service:'EODILO', snum:'".$snum."', id:'".$IotLog->log_no."'}";  
           
            $return["result"] = $mqtt->ConnectAndPublish($topic, $message, $client_id);
            $return["log"] = $IotLog;
            return $return;
        }

        public function Subscribe($topic){
            $mqtt = new Mqtt();
            $rtn = [];

            $client_id = "";
            $mqtt->ConnectAndSubscribe($topic, function($topic, $message){

                if($message == "end"){
                    $rtn = [
                        'topic' => $topic,
                        'message' => $message
                    ];
                }else if($message == "no"){
                    $rtn = [
                        'topic' => $topic,
                        'message' => $message
                    ];
                }else{
                    return "end";
                }
                
                return $topic;

            }, $client_id);     
            //$mqtt->loop(true);
            return $rtn;
        }








        public function deviceIOT($seat, $iot, $status){

            Config::set('database.connections.partner.database', "boss_" . $this->partner->p_id);
            $this->FrenchSeat = FrenchSeat::where("s_no",$seat)->first();

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

            $topic = $this->FrenchConfig->cf_iot_base . '/' . $this->FrenchRoom->r_iot1;
            $iot =$this->FrenchRoom->r_iot2;

            $id = 0;

            if( $status == "O" ) {
                $snum = $status.$iot;
                $message = "{snum:'".$snum."', id:'$id'}";
            } elseif( $status == "F" ) {
                $snum = $status.$iot;
                $message = "{snum:'".$snum."', id:'$id'}";
            } else {
                return response()->json([
                    "result" => false,
                    "topic" => $topic,
                    "message" => "관리자에게 문의해주세요.  [NO STATUS]",
                ]);
            }


            $client_id = 1;
            $output = $this->Publish($topic, $message, $client_id);

            if ($output === true)
            {
                return response()->json([
                    "result" => true,
                    "topic" => $topic,
                    "command" => $message,
                    "message" => "요청이 등록되었습니다.",
                    //"status" => $request->status,  // 이것은 다시 가져와야함...
                ]);

            } else {

                return response()->json([
                    "result" => false,
                    "topic" => $topic,
                    "command" => $message,
                    "message" => "관리자에게 문의해주세요. [FAIL DEV]",
                ]);

            }

        }

        public function seatIOT($seat, $iot, $status){

            Config::set('database.connections.partner.database', "boss_" . $this->partner->p_id);
            $this->FrenchSeat = FrenchSeat::where("s_no",$seat)->first();

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

            if( $iot == "room_door" ) {

                $this->FrenchRoom = FrenchRoom::find($this->FrenchSeat->s_room);

                $topic = $this->FrenchConfig->cf_iot_base . '/' . $this->FrenchRoom->r_iot1;
                $iot = $this->FrenchRoom->r_iot2;
            }

            if( $iot == "light" ) {
                $topic = $this->FrenchConfig->cf_iot_base . '/' . $this->FrenchSeat->s_iot1;
                $iot = $this->FrenchSeat->s_iot2;
            }

            //$topic = '19/C0';
            //$snum = "O0017" D2  OD21
            //$this->FrenchSeat->s_iot2 = "D21";

            // 조명 C0 / 0017
            // 출입문 D2 / D21
            if( $status == "O" ) {
                $snum = $status.$iot;
                $message = "{snum:'".$snum."', id:'1'}";
            } elseif( $status == "F" ) {
                $snum = $status.$iot;
                $message = "{snum:'".$snum."', id:'1'}";
            } else {
                return response()->json([
                    "result" => false,
                    "topic" => $topic,
                    "message" => "관리자에게 문의해주세요.  [NO STATUS]",
                ]);
            }


            return response()->json([
                "result" => false,
                "message" => "테스트중입니다.",
            ]);            

           
            $client_id = 1;
            $output = $this->Publish($topic, $message, $client_id);

            if ($output === true)
            {
                return response()->json([
                    "result" => true,
                    "topic" => $topic,
                    "command" => $message,
                    "message" => "요청이 등록되었습니다.",
                    //"status" => $request->status,  // 이것은 다시 가져와야함...
                ]);

            } else {

                return response()->json([
                    "result" => false,
                    "topic" => $topic,
                    "command" => $message,
                    "message" => "관리자에게 문의해주세요. [FAIL DEV]",
                ]);

            }

        }

    }
}
