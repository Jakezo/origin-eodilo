<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchRoom;
use App\Models\FrenchSeat;
use App\Models\FrenchSeatLevel;
use App\Models\FrenchReservSeat;
use App\Models\FrenchIot;

use App\Models\FrenchMember;
use App\Models\FrenchProductOrder;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use App\Http\Controllers\AlimTalkController;

class FrenchReserveInfoController extends Controller
{
    public $FrenchRerservation;

    public $FrenchRoom;
    public $FrenchSeat;
    public $FrenchSeatLevel;
    public $FrenchReservSeat;

    public function __construct()
    {
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchSeatLevel = new FrenchSeatLevel();
        $this->FrenchRoom = new FrenchRoom();
        $this->FrenchReservSeat = new FrenchReservSeat();
        
        //$this->FrenchRerservation = new FrenchMember();
    }

    // 예약정보
    public function reserveInfo(Request $request)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account);                

        ## 현재시간 예약정보
        $data['result'] = true;
        $data['reserve'] = \App\Models\FrenchReservSeat::find($request->rv);

        if( !$data['reserve'] ) {
            $data['result'] = false;  
            $data['message'] = "예약정보가 존재하지 않습니다.";
            return response($data);
        }

        $data['seat'] = \App\Models\FrenchSeat::find($data['reserve']['rv_seat']);

        return view("partner.reserve/popupReserveInfo", $data);
    } 


    // 예약정보
    public function get_reserveInfo(Request $request)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account);                

        ## 현재시간 예약정보
        $data['result'] = true;
        $data['reserve'] = \App\Models\FrenchReservSeat::find($request->rv);
        $data['seat'] = \App\Models\FrenchSeat::select("s_name")->find($data['reserve']['rv_seat']);

        return response($data);
    }  


    public function reserveRefundInfo(Request $request) {

        Config::set('database.connections.partner.database',"boss_".$request->account);                

        $ndt = now()->format("Y-m-d H:i:s");

        ## 현재시간 예약정보
        $data['currentReserve'] = \App\Models\FrenchReservSeat::find($request->rv);

        if( !$data['currentReserve']  ) {
            $data['result'] = false;  
            $data['message'] = "예약정보가 존재하지 않습니다.";
            return response($data);
        }
        if( $data['currentReserve']->rv_sdate >= $ndt ) {
            $data['result'] = false;  
            $data['message'] = "아직 입실 전입니다.";
            return response($data);
        }
        if( $data['currentReserve']->rv_edate <= $ndt ) {
            $data['result'] = false;  
            $data['message'] = "이미 이용시간이 지났습니다.".$data['currentReserve']->rv_edate.":".$ndt;
            return response($data);
        }

        if ($data['currentReserve']->rv_state_seat == "END") {
            $data['result'] = false;
            $data['message'] = "종료된 예약정보입니다.";
            return response($data);
        }

        $data['currentOrder'] = \App\Models\FrenchProductOrder::find($data['currentReserve']->rv_order);
        if( !$data['currentOrder'] ) {
            $data['result'] = false;  
            $data['message'] = "";  
            return response($data);
        }

        $data['PriceArr'] = $this->reserveRefundPriceArr($data['currentOrder'], $data['currentReserve']);


        ## 이미 환불요청이라면...
        if ($data['currentOrder']->o_refund == "A") {
            $data['result'] = false;  
            $data['message'] = "이미 환불신청상태입니다.";  
            return response($data);
        }   
        
        
        if( $request->mode == "form" ) {
            ## 변경가능시간
            

        }
        if( $request->mode == "action" ) {
            $data['result'] = false;  
            $data['message'] = "실행중....";  

            $s_time = Carbon::createFromFormat('Y-m-d H:i:s', $data['currentReserve']->rv_sdate)->getTimeStamp();
            $n_time = now()->getTimeStamp();

            $data['currentReserve']->rv_state_seat = "END";
            $data['currentReserve']->rv_used_time = $n_time - $s_time;

            if ($data['currentReserve']->rv_duration_type == "T") {
                $data['currentReserve']->rv_duration_time = $data['currentReserve']->rv_duration * 3600;
    
                // remaind 추가
            } elseif ($data['currentReserve']->rv_duration_type == "D") {
                $data['currentReserve']->rv_duration_time = $data['currentReserve']->rv_duration * 86400;
            } elseif ($data['currentReserve']->rv_duration_type == "M") {
                $data['currentReserve']->rv_duration_time = $data['currentReserve']->rv_duration * 86400;
            }            

            $data['currentReserve']->rv_duration_time = $data['currentReserve']->rv_duration_time;
            $data['currentReserve']->rv_state_seat = $data['currentReserve']->rv_state_seat;
            $data['currentReserve']->rv_used_time = $data['currentReserve']->rv_used_time;   
            $data['currentReserve']->rv_edate = $ndt;
            $data['currentReserve']->rv_state_seat_out = $ndt;

            ## 시간권은 남은시간에 재적립
            if ($data['currentReserve']->rv_duration_type == "T") {

                $data["remaining_time"]  = floor( ($data['currentReserve']->rv_duration_time - $data['currentReserve']->rv_used_time) / 3600 );
                // remaind 추가                

                $data['currentOrder']->o_remainder = $data["remaining_time"];
                $data['currentOrder']->o_remainder_time = $data["remaining_time"];
            }     

            if ($data['currentReserve']->update()) {
                $data['currentOrder']->update();  
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }
            
        }

        $data['result'] = true;  
        return response($data);  

    }
    


    // 환불을 위한 금액 확인
    public function reserveRefundPriceArr($order, $rv)
    {

        Config::set('database.connections.partner.database', "boss_" . $rv->partner);

        $data = [];
        $FrenchProductOrder = new FrenchProductOrder;
        ## 전체금액
        $data["total_used_time"] = FrenchReservSeat::where("rv_order", $order->o_no)->sum('rv_used_time');

        // 기간단위로 자름..
        if ($order->o_duration_type == "T") {
            $data["total_used_duration"] = ceil($data["total_used_time"] / 3600);
        } elseif ($order->o_duration_type == "D") {
            $data["total_used_duration"] = ceil($data["total_used_time"] / 86400);
        } elseif ($order->o_duration_type == "M") {
            $data["total_used_duration"] = ceil($data["total_used_time"] / 86400);
        } else {
            $data["total_used_duration"] = 0;
        }

        # 같은 조건의 사용시간에 대한 비용 확인......

        // 선택된 좌석정보
        $this->FrenchSeat = FrenchSeat::where("s_no", $rv->rv_seat)->first();

        // 선택된 좌석레벨정보
        $this->FrenchSeatLevel = FrenchSeatLevel::where("sl_no", $this->FrenchSeat->s_level)->first();

        if ($order->o_product_kind == "P" || $order->o_product_kind == "T") {
            $price_data = json_decode($this->FrenchSeatLevel->sl_price_time, true);
        } else {
            $price_data = json_decode($this->FrenchSeatLevel->sl_price_day, true);
        }

        if ($data["total_used_duration"] == 0) {
            ## 기간단위가 없다면 환불불가능 관리자에게 문의해주세요.
            if (isset($price_data) && isset($price_data[$data["total_used_duration"]]) && $price_data[$data["total_used_duration"]]) {
                $price_info = $price_data[$data["total_used_duration"]][$order->o_ageType][$order->o_priceType];
            } else {
                $price_info = [
                    "S" => 0,
                    "R" => 0,
                    "T" => 0
                ];
            }
        } else {
            $price_info = $price_data[$data["total_used_duration"]][$order->o_ageType][$order->o_priceType];
        }


        ## 사용시간에 대한 금액
        //$price_info['T']; // T:토탈 S:스터디룸 R:독서실

        ## 환불할 금액 : 좌석결제금액 - 사용금액
        $data["total_price"] = $order->o_price_seat;
        $data["used_price"] = (int)$price_info['T'];

        ## 예외 하루이용권
        if( $order->o_product_kind == "A" ) {
            $data["used_price"] = $data["total_price"];
        }         

        $data["refund_pirce"] = $data["total_price"] - $data["used_price"];

        return $data;
    }  

    // 시간연장
    public function reserveExtendTime(Request $request)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account);                

        $currentReserve = \App\Models\FrenchReservSeat::find($request->rv);
        $currentOrder = \App\Models\FrenchProductOrder::find($currentReserve->rv_order);

        $currentSeat = \App\Models\FrenchSeat::find($currentReserve['rv_seat']);
        $currentSeatLevel = \App\Models\FrenchSeatLevel::find($currentSeat['s_level']);


        // 종료시간 이후 예약가능한지 확인
        $nextReserveInfo = \App\Models\FrenchReservSeat::where("rv_no", "!=", $currentReserve['rv_no'])
                        ->where("rv_seat", $currentReserve['rv_seat'])
                        ->where("rv_sdate", ">", $currentReserve->rv_edate)
                        ->where(DB::raw("date_format(rv_sdate,'%Y-%m-%d')"), '=', now()->format("Y-m-d") )
                        //->where("rv_sdate", '>', $currentReserve->rv_edate)
                        ->orderBy("rv_sdate", "asc")
                        ->first();   

        $time_term =[];
        
        $t1_time = Carbon::createFromFormat('Y-m-d H:i:s', $currentReserve->rv_edate);
        // 다음예약이 있다면 
        if( $nextReserveInfo ) {
            $t2_time = Carbon::createFromFormat('Y-m-d H:i:s', $nextReserveInfo->rv_sdate);
        } else {

            if( $currentOrder->o_product_kind == "A" ){
                $data['result'] = false;
                $data['message'] = "하루이용권은 연장이 불가능합니다. 신규예약을 해주세요.";
                return response($data);
            } elseif(  $currentOrder->o_product_kind == "D"  ) {
                // 기간추가는 예약이 없어도 기존예약기간만큼만 가능하다.
                $t2_time = Carbon::createFromFormat('Y-m-d H:i:s', $currentReserve->rv_edate)->addDays($currentReserve->rv_duration);
               

             } else if( $currentOrder->o_product_kind == "T" ) {
                // 영업마감시간
                $t2_time = Carbon::createFromFormat('Y-m-d H:i:s', now()->addDays(1)->format("Y-m-d 00:00:00"));
             }               
            
        }
        //$data['message'] = "영업마감시간".$t2_time;

        // 현재시간
        $now_time = Carbon::now();

        // 남은시간
        $t3_time = $now_time->timestamp - $t1_time->timestamp;

        $time_term = $t2_time->timestamp - $t1_time->timestamp;
 
        
        $data['result'] = false;
        $data['t1_time'] = $t1_time->timestamp;
        $data['t2_time'] = $t2_time->timestamp;

        if(  $currentOrder->o_product_kind == "D"  ) {
            $data['times_type'] = "D";
            $data['times'] = floor($time_term / 86400);
         
         } else if( $currentOrder->o_product_kind == "T" ) {
            $data['times_type'] = "T";
            $data['times'] = floor($time_term / 3600);
         }              

        // 시간선택도 했다면 금액도 추가함.
        if( $request->duration || $request->mode == "action") {
            if ( $currentReserve->rv_product_kind == "A" || $currentReserve->rv_product_kind == "P" || $currentReserve->rv_product_kind == "T" ) {
                $price_data = json_decode($currentSeatLevel->sl_price_time, true);
            } else {
                $price_data = json_decode($currentSeatLevel->sl_price_day, true);
            }
            $data['duration'] = $request->duration;
            $data['price'] = $price_data[$request->duration][$currentReserve->rv_ageType]['X']['T'];

            $ageTypeArr = config("product.memberAgeType"); 
            $BuyTypeArr = config("product.productBuyType");     
            $data['price_msg'] = $currentSeatLevel->sl_name . " / " . $ageTypeArr[$currentReserve->rv_ageType] . " / ".  $BuyTypeArr['X'];
        }

        if( $request->mode == "action" ) {
            $r_sdt = Carbon::createFromFormat('Y-m-d H:i:s', $currentReserve->rv_edate );
            $r_edt = Carbon::createFromFormat('Y-m-d H:i:s', $currentReserve->rv_edate )->addHour($request->duration);


            $newOrder = $currentOrder->replicate();
            $newOrder->o_partner = $request->account_no;
            $newOrder->o_member_from = "L";
            $newOrder->o_priceType = "X";
            $newOrder->o_device_from = "A";
            $newOrder->o_duration = $request->duration;
            $newOrder->o_remainder = $request->duration;
            $newOrder->o_remainder_time = 0;
            $newOrder->o_remainder_day = 0;
            $newOrder->o_remainder_point = 0;
            if( $currentOrder->o_product_kind == "A" ){
                $newOrder->o_remainder_day = 1;  
                $newOrder->o_duration_type = "D"; 
            } elseif(  $currentOrder->o_product_kind == "D"  ) {
                $newOrder->o_remainder_day = $request->duration ?? 0;  
                $newOrder->o_duration_type = "D"; 
             } else if( $currentOrder->o_product_kind == "T" ) {
                $newOrder->o_remainder_time = $request->duration ?? 0;  
                $newOrder->o_duration_type = "T"; 
             } else if( $currentOrder->o_product_kind == "P" ) {
                $newOrder->o_remainder_point = $request->duration ?? 0;  
                $newOrder->o_duration_type = "P"; 
             } else {
                 $newOrder->o_duration_type = ""; 
             }            



            $newOrder->o_sdate =  $r_sdt->format("Y-m-d H:i:s");
            $newOrder->o_edate =  $r_edt->format("Y-m-d H:i:s");
            $newOrder->o_price_seat = $request->b_pay_money;
            $newOrder->o_price_total = $request->b_pay_money;

            $newOrder->o_coupon = $newOrder->o_coupon_discount = $newOrder->o_pay_cash = $newOrder->o_pay_point = $newOrder->o_pay_money = $newOrder->o_refund_price = $newOrder->o_refund_money = 0;
            $newOrder->o_pay_money =  $request->b_pay_money;
            $newOrder->o_pay_kind = $request->b_pay_kind;
            $newOrder->o_pay_state = $request->b_pay_state;
            $newOrder->o_pay_at = now();

            $newOrder->created_at = Carbon::now();
            $data['newOrder'] = $newOrder;
            if( $newOrder->save() ) {

                $newReserve = $currentReserve->replicate();
                $newReserve->created_at = Carbon::now();
                $newReserve->rv_state = "A"; 
                $newReserve->rv_duration = $request->duration; 
                $newReserve->rv_state_seat = ""; 


                $newReserve->rv_sdate = $r_sdt->format("Y-m-d H:i:s");
                $newReserve->rv_edate = $r_edt->format("Y-m-d H:i:s");  

                $data['newReserve'] = $newReserve;
                $newReserve->save(); 
                $data['result'] = true;
            } else {
                $data['message'] = "관리자에게 문의해주세요.";

            }
         
        }

        return response($data);    

        // 해당 시간에 예약이 있는지 확인
        $r_sdt = $request->rv_edate;
        $r_edt = Carbon::createFromFormat('Y-m-d H:i', $request->b_sdate . " " . substr($request->b_stime,0,5))->addHour($request->b_duration);

        if ($currentSeat->s_no != $request->b_seat) {
            $data['result'] = false;
            $data['message'] = "좌석 정보가 일치하지 않습니다.";
            return response($data);
        }

        if ($currentReserve->rv_sdate == $r_sdt->format("Y-m-d H:i:s") ) {
            $data['result'] = false;
            $data['message'] = "같은 시간입니다.";
            return response($data);
        }

        // 예약이 가능한 시간인지 확인
        $dupReserveInfo = \App\Models\FrenchReservSeat::
                        where("rv_seat", $currentReserve['rv_seat'])
                        ->where("rv_no", '!=', $currentReserve['rv_no'])
                        ->where(function ($query) use ( $request) {
                            $query->where([
                                ['rv_sdate', '>=', $request->b_sdate . " " . $request->b_stime],
                                ['rv_sdate', '<=', $request->b_edate . " " . $request->b_etime],
                            ])
                            ->orwhere([
                                ['rv_edate', '>=', $request->b_sdate . " " . $request->b_stime],
                                ['rv_edate', '<=', $request->b_edate . " " . $request->b_etime],
                            ]);
                        })->first();        


        if ( $dupReserveInfo ){
                $data['result'] = false;
                $data['message'] = "이미 예약된 시간입니다. <br>".$dupReserveInfo->rv_member_name." / ".$dupReserveInfo->rv_sdate." ~ ".$dupReserveInfo->rv_edate;
                return response($data);
        }
    
        // 시간변경실행
        if ($currentReserve->rv_sdate > now()->format("Y-m-d H:i")) {

            $currentReserve->rv_sdate = $r_sdt->format("Y-m-d H:i:s");
            $currentReserve->rv_edate = $r_edt->format("Y-m-d H:i:s");

            if ($currentReserve->update()) {
                //$data['result'] = $this->MobileReservSeat->update();

                if( $currentReserve->rv_member_from == "M") {
                    $MobileReserve = \App\Models\MobileReservSeat::where("rv_partner_rv",$currentReserve->rv_no);
                    $MobileReserve->rv_sdate = $r_sdt->format("Y-m-d H:i:s");
                    $MobileReserve->rv_edate = $r_edt->format("Y-m-d H:i:s");
                    $MobileReserve->update();
                }

                $data['result'] = true;
                $data['message'] = "예약 시간이 변경되었습니다. ". $currentReserve->rv_sdate . " ~ " . $currentReserve->rv_edate;
                return response($data);
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }
        } else {
            $data['result'] = false;
            $data['message'] = "이미 예약시간이 지났습니다. 환불후 다시 예약 해주세요.<br>";
            return response($data);
        }

    }  

    // 예약정보
    public function reserveChangeTimeOk(Request $request)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account);                

        $currentReserve = \App\Models\FrenchReservSeat::find($request->rv);
        $currentSeat = \App\Models\FrenchSeat::find($currentReserve['rv_seat']);

        // 해당 시간에 예약이 있는지 확인
        $r_sdt = Carbon::createFromFormat('Y-m-d H:i', $request->b_sdate . " " . substr($request->b_stime,0,5));
        $r_edt = Carbon::createFromFormat('Y-m-d H:i', $request->b_sdate . " " . substr($request->b_stime,0,5))->addHour($request->b_duration);

        if ($currentSeat->s_no != $request->b_seat) {
            $data['result'] = false;
            $data['message'] = "좌석 정보가 일치하지 않습니다.";
            return response($data);
        }

        if ($currentReserve->rv_sdate == $r_sdt->format("Y-m-d H:i:s") ) {
            $data['result'] = false;
            $data['message'] = "같은 시간입니다.";
            return response($data);
        }

        // 예약이 가능한 시간인지 확인
        $dupReserveInfo = \App\Models\FrenchReservSeat::
                        where("rv_seat", $currentReserve['rv_seat'])
                        ->where("rv_no", '!=', $currentReserve['rv_no'])
                        ->where(function ($query) use ( $request) {
                            $query->where([
                                ['rv_sdate', '>=', $request->b_sdate . " " . $request->b_stime],
                                ['rv_sdate', '<=', $request->b_edate . " " . $request->b_etime],
                            ])
                            ->orwhere([
                                ['rv_edate', '>=', $request->b_sdate . " " . $request->b_stime],
                                ['rv_edate', '<=', $request->b_edate . " " . $request->b_etime],
                            ]);
                        })->first();        


        if ( $dupReserveInfo ){
                $data['result'] = false;
                $data['message'] = "이미 예약된 시간입니다. <br>".$dupReserveInfo->rv_member_name." / ".$dupReserveInfo->rv_sdate." ~ ".$dupReserveInfo->rv_edate;
                return response($data);
        }
    
        // 시간변경실행
        if ($currentReserve->rv_sdate > now()->format("Y-m-d H:i")) {

            $currentReserve->rv_sdate = $r_sdt->format("Y-m-d H:i:s");
            $currentReserve->rv_edate = $r_edt->format("Y-m-d H:i:s");

            if ($currentReserve->update()) {
                //$data['result'] = $this->MobileReservSeat->update();

                if( $currentReserve->rv_member_from == "M") {
                    $MobileReserve = \App\Models\MobileReservSeat::where("rv_partner_rv",$currentReserve->rv_no);
                    $MobileReserve->rv_sdate = $r_sdt->format("Y-m-d H:i:s");
                    $MobileReserve->rv_edate = $r_edt->format("Y-m-d H:i:s");
                    $MobileReserve->update();
                }

                $data['result'] = true;
                $data['message'] = "예약 시간이 변경되었습니다. ". $currentReserve->rv_sdate . " ~ " . $currentReserve->rv_edate;
                return response($data);
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }
        } else {
            $data['result'] = false;
            $data['message'] = "이미 예약시간이 지났습니다. 환불후 다시 예약 해주세요.<br>";
            return response($data);
        }

    }  

    // 변경가능 좌석정보
    public function reserveChangeSeat(Request $request)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account);                

        $currentReserve = \App\Models\FrenchReservSeat::find($request->rv);

        // 종료
        if( $currentReserve->rv_edate < now() ) {
            $data['result'] = true;
            $data['message'] = "이미 종료된 예약입니다.";
            return response($data);
        }

        // 아직 입실전이라면 해당시간 아니면 현재부터 종료시까지       
        if( $currentReserve->rv_sdate > now() ) {
                $r_sdt = $currentReserve->rv_sdate;
                $r_edt = $currentReserve->rv_edate;
        } else {
            $r_sdt = now();
            $r_edt = $currentReserve->rv_edate;
        }        

        $currentSeat = \App\Models\FrenchSeat::find($currentReserve['rv_seat']);
        // 해당 시간에 예약이 있는지 확인
        $data['ageType'] = $currentReserve->rv_ageType;
        $data['sex'] = $currentReserve->rv_sex;
        // 예약이 가능한 시간인지 확인
        $data['seats'] = \App\Models\FrenchSeat::where("s_no", "!=", $currentReserve['rv_seat'])
                        ->leftJoin("french_rooms","french_rooms.r_no","french_seats.s_room")
                        ->where(function ($query) use ( $currentReserve ) {
                            $query->where('s_sex', '=', $currentReserve->rv_sex)
                            ->orwhere('s_sex', 'A');
                        })
                        ->where(function ($query) use ( $currentReserve ) {
                            $query->where('s_age', '=', $currentReserve->rv_ageType)
                            ->orwhere('s_age',  'A');
                        })
                        ->orderBy("r_name", "desc")
                        ->get();

        $data['result'] = true;
        return response($data);

    
        // 시간변경실행
        if ($currentReserve->rv_sdate > now()->format("Y-m-d H:i")) {

            $currentReserve->rv_sdate = $r_sdt->format("Y-m-d H:i:s");
            $currentReserve->rv_edate = $r_edt->format("Y-m-d H:i:s");

            if ($currentReserve->update()) {
                //$data['result'] = $this->MobileReservSeat->update();

                if( $currentReserve->rv_member_from == "M") {
                    $MobileReserve = \App\Models\MobileReservSeat::where("rv_partner_rv",$currentReserve->rv_no);
                    $MobileReserve->rv_sdate = $r_sdt->format("Y-m-d H:i:s");
                    $MobileReserve->rv_edate = $r_edt->format("Y-m-d H:i:s");
                    $MobileReserve->update();
                }

                $data['result'] = true;
                $data['message'] = "예약 시간이 변경되었습니다. ". $currentReserve->rv_sdate . " ~ " . $currentReserve->rv_edate;
                return response($data);
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }
        } else {
            $data['result'] = false;
            $data['message'] = "이미 예약시간이 지났습니다. 환불후 다시 예약 해주세요.<br>";
            return response($data);
        }

    }  



    // 변경가능 좌석정보
    public function reserveChangeSeatOk(Request $request)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account);                

        $currentReserve = \App\Models\FrenchReservSeat::find($request->rv);

        // 종료
        if( $currentReserve->rv_edate < now()->format("Y-m-d H:i:s") ) {
            $data['result'] = true;
            $data['message'] = "이미 종료된 예약입니다.";
            return response($data);
        }

        if( $currentReserve->rv_edate < now()->addHours(1)->format("Y-m-d H:i:s") ) {
            $data['result'] = true;
            $data['message'] = "종료 1시간전에는 이동이 불가능합니다.";
            return response($data);
        }

        // 아직 입실전이라면 해당시간 아니면 현재부터 종료시까지       
        if( $currentReserve->rv_sdate > now() ) {
                $r_sdatetime = $currentReserve->rv_sdate;
                $r_edatetime = $currentReserve->rv_edate;
        } else {
                $r_sdatetime = now()->format("Y-m-d H:i:s");
                $r_edatetime = $currentReserve->rv_edate;
        }
        $currentSeat = \App\Models\FrenchSeat::find($currentReserve['rv_seat']);
        $newSeat = \App\Models\FrenchSeat::find($request->newSeat);

        
        $durationReserv = \App\Models\FrenchReservSeat::where("rv_seat", $request->newSeat)
        ->where(function ($query) use ( $r_sdatetime, $r_edatetime ) {
            $query->where([
                ['rv_sdate', '>=', $r_sdatetime],
                ['rv_sdate', '<=', $r_edatetime],
            ])
            ->orwhere([
                ['rv_edate', '>=', $r_sdatetime],
                ['rv_edate', '<=', $r_edatetime],
            ]);
        })        
        ->first();

        $currentReserve = \App\Models\FrenchReservSeat::find($request->rv);                


        ## 입실전이면 좌석번호만 변경, 입실후면 현재시간까지 종료하고 신규예약을 생성
        if( $currentReserve->rv_sdate > now() ) {
            $currentReserve->rv_seat = $newSeat->s_no;
            $currentReserve->update();
        } else {
            $newReserve = $currentReserve->replicate();
            $newReserve->created_at = Carbon::now();
            $newReserve->rv_state = "U"; 
            $newReserve->rv_state_seat = "IN"; 
            $newReserve->rv_sdate = $r_sdatetime;
            $newReserve->rv_edate = $r_edatetime;  
            $newReserve->save();

            $currentReserve->rv_state = "U"; 
            $currentReserve->rv_state_seat = "OUT"; 
            $currentReserve->rv_edate = $r_sdatetime;      
            $currentReserve->update();
        }   

        if( $newReserve->rv_no )  {
                $data['result'] = true;
                $data['message'] = "자리를 이동하였습니다.";
                return response($data);
        } else {
            $data['result'] = false;
            $data['message'] = "정상적으로 처리되지 않았습니다.";
            return response($data);    
        }
    } 

    // 메모저장
    function setUserResMemo(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $FrenchReservSeat = \App\Models\FrenchReservSeat::find( $request->rv);

        if( $FrenchReservSeat ) {
            $FrenchReservSeat->rv_memo = $request->memo;
            $result['result'] = $FrenchReservSeat->update();
        } else {
            $result['result'] = false;
            $result['message'] = "해당 예약이 존재하지 않습니다.";
        }


        return response($result);

    }

}
