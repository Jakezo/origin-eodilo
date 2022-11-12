<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Classes\Iot;
use App\Models\FrenchMember;
use App\Models\FrenchReservSeat;
use App\Models\FrenchProductOrder;
use App\Models\FrenchIot;
use App\Models\MobileReservSeat;
use App\Models\MobileProductOrder;
use App\Models\FrenchSeat;
use App\Models\FrenchDayEnd;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class FrenchWorkController extends Controller
{


    public function __construct()
    {
        $this->FrenchReservSeat = new FrenchReservSeat();     
        $this->MobileReservSeat = new MobileReservSeat();    
        $this->MobileProductOrder  = new MobileProductOrder();    
    }
 
    ## 종료
    public function day_end(Request $request)
    {        
        Config::set('database.connections.partner.database',"boss_".$request->account);        

        $data['date'] = date("Y-m-d");
        $data['dayend'] = \App\Models\FrenchDayEnd::where('de_date',date("Y-m-d"))->first();
        return view('partner.work.day_end',$data);
    }

    public function reserveEnd($reserve){
        $reserve2 = $reserve;

        $this->FrenchProductOrder = null;
        $this->MobileReservSeat = null;
        $this->MobileProductOrder = null;

        $s_time = Carbon::createFromFormat('Y-m-d H:i:s', $reserve->rv_sdate)->getTimeStamp();
        $n_time = now()->getTimeStamp();
        $u_time = $n_time - $s_time; // 사용시간

        if ($reserve->rv_duration_type == "T") {
            $reserve->rv_duration_time = $reserve->rv_duration * 3600; // 시간권은 시간단위로

            // remaind 추가
        } elseif ($reserve->rv_duration_type == "D") {
            $reserve->rv_duration_time = $reserve->rv_duration * 86400;
        } elseif ($reserve->rv_duration_type == "M") {
            $reserve->rv_duration_time = $reserve->rv_duration * 86400;
        }            

        $reserve->rv_duration_time = $reserve->rv_duration_time;
        $reserve->rv_state_seat = "END";
        $reserve->rv_used_time = $u_time;   
        $reserve->rv_edate = now()->format("Y-m-d H:i:s");
        $reserve->rv_state_seat_out = now()->format("Y-m-d H:i:s");
        

        $this->FrenchProductOrder = FrenchProductOrder::find($reserve->rv_order);
        if( $reserve->rv_member_from == "M") {

            // 모바일 예약내역 업데이트
            $this->MobileReservSeat = MobileReservSeat::where("rv_partner_rv" , $reserve->rv_no)->first();

            // 모바일 구내내역 업데이트
            $this->MobileProductOrder = MobileProductOrder::find($this->MobileReservSeat->rv_order);
         
        }

        ## 시간권은 남은시간에 재적립
        if ($reserve->rv_duration_type == "T") {
            $remaining_time  = floor( ($reserve->rv_duration_time - $u_time) / 3600 );

            // remaind 추가      
            $this->FrenchProductOrder->o_remainder += $remaining_time ?? 0 ;
            $this->FrenchProductOrder->o_remainder_time += $remaining_time ?? 0; 

            if( $this->MobileProductOrder ) {
                $this->MobileProductOrder->o_remainder += $remaining_time ?? 0 ;
                $this->MobileProductOrder->o_remainder_time += $remaining_time ?? 0 ;
            }            

        }  
        if ($reserve->rv_duration_type == "D") {
            // 그날을 제했긴 때문에 남은시간에 변화없음
        }  

        $result['FR'] = $reserve->update();
        if( $this->FrenchProductOrder ) $result['FO'] = $this->FrenchProductOrder->update(); 
        if( $this->MobileReservSeat ) {
            $this->MobileReservSeat->rv_state_seat = $reserve->rv_state_seat;
            $this->MobileReservSeat->rv_used_time = $reserve->rv_used_time;   
            $this->MobileReservSeat->rv_edate = $reserve->rv_edate;
            $this->MobileReservSeat->rv_state_seat_out = $reserve->rv_state_seat_out;
            $result['MR'] = $this->MobileReservSeat->update();
        }
        if( $this->MobileProductOrder ) {
            $result['MO'] = $this->MobileProductOrder->update();
        }

        $result['PT'] = $reserve->rv_product_type;
        return $result;

    }

    public function day_end_action(Request $request)
    {        
        Config::set('database.connections.partner.database',"boss_".$request->account);   

        $partner = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

        $IOT = new IOT();
        $IOT->setPartner($partner->p_no); 

        $data["result"] = true;
        $end_count = $end_iot = 0;
        $end_result = [];

        if( $request->mode == "start" ) {
            $data["mode"] = "start";

            # COMMAND3 모든 IOT OFF  
            if( $request->command1 == "Y" ) {                  

                // 모든좌석 퇴실처리
                $reservs = \App\Models\FrenchReservSeat::select(['french_reserv_seats.*','french_members.mb_name','french_members.mb_phone','french_rooms.r_name','french_seats.s_name'])
                ->where('rv_state_seat', '<>', 'END')
                ->where('rv_sdate', '<=', now())
                ->where('rv_edate', '>=', now())
                ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_reserv_seats.rv_member')
                ->leftjoin('french_rooms', 'french_rooms.r_no', '=', 'french_reserv_seats.rv_room')
                ->leftjoin('french_seats', 'french_seats.s_no', '=', 'french_reserv_seats.rv_seat')
                ->orderBy("rv_no","desc")->get();
                $data["reservs"] = $reservs;

                foreach( $reservs as $reserv ) {
                    
                    $update_result = $this->reserveEnd($reserv);

                    if( $update_result['PT'] ) $end_result[$update_result['PT']]++;
                    $end_count++;

                    // 해당좌석 소등명령 ::: 아래 전체 소등으로 변경함...
                    // $seat = \App\Models\FrenchSeat::select(["s_no", "s_iot1", "s_iot2"])->where("s_no",$reserv->rv_seat)->first();
                    // if( $seat->s_iot1 && $seat->s_iot2 ) {
                    //     $output = $IOT->PublishGo($seat->s_iot1, $seat->s_iot2, "F");
                    //     //echo $seat->s_no .":". $IOT->FrenchConfig->cf_iot_base  . ":" . $seat->s_iot1 . ":" . $seat->s_iot2 . ":" . $status."<br/>";
                    // } 
                }

                $data["work_msg"][] = number_format($end_count)."예약을 종료하였습니다.";
            }

            # COMMAND2 모든 IOT OFF            
            if( $request->command2 == "Y" ) {            
                $data["seats"] = \App\Models\FrenchSeat::select(["s_no", "s_iot1", "s_iot2"])->orderBy("s_no","desc")->get();
                foreach( $data["seats"] as $seat ) {
                    if( $seat->s_iot1 && $seat->s_iot2 ) {
                        $status = "F";
                        $output = $IOT->PublishGo($seat->s_iot1, $seat->s_iot2, $status);
                        $end_iot++;    
                    }
                }

                $data["work_msg"][] = number_format($end_iot)."개 좌석 소등명령이 완료되었습니다.";
            }

            # COMMAND4 모든 IOT OFF
            if( $request->command3 == "Y"  ) {
                $data["iots"] = \App\Models\FrenchIot::where("i_endwork","Y")->orderBy("i_no","asc")->get();

                foreach( $data["iots"] as $iot_device ) {
                    if( $iot_device->i_iot1 && $iot_device->i_iot2 ) {
                        $output = $IOT->PublishGo($iot_device->i_iot1, $iot_device->i_iot2, "F");
                        $data["work_msg"][] = "IOT " . $iot_device->i_name .  " OFF 명령이 완료되었습니다.";
                     }

                }    
            }

            $FrenchDayEnd = \App\Models\FrenchDayEnd::where('de_date',$request->date)->first();
            if( $FrenchDayEnd ) {
                $FrenchDayEnd->de_date = $request->date;
                $FrenchDayEnd->de_command1 = $request->command1;
                $FrenchDayEnd->de_command2 = $request->command2;
                $FrenchDayEnd->de_command3 = $request->command3;
                $FrenchDayEnd->de_command4 = $request->command4;
                $FrenchDayEnd->update();
            } else {
                $FrenchDayEnd = new \App\Models\FrenchDayEnd;
                $FrenchDayEnd->de_date = $request->date;
                $FrenchDayEnd->de_command1 = $request->command1;
                $FrenchDayEnd->de_command2 = $request->command2;
                $FrenchDayEnd->de_command3 = $request->command3;
                $FrenchDayEnd->de_command4 = $request->command4;
                $FrenchDayEnd->save();
            }



        }elseif( $request->mode == "stop" ) {
            $data["mode"] = "stop";
            
        }

        return response($data);
    }


    ## 남은시간
    public function remaining_time(Request $request)
    {      
        Config::set('database.connections.partner.database',"boss_".$request->account);        

		$data["remaind_time"] = \App\Models\FrenchProductOrder::where("o_remainder",">",0)
		->where("o_product_kind","T")->sum("o_remainder_time");


		$data["remaind_day"] = \App\Models\FrenchProductOrder::where("o_remainder",">",0)
		->where("o_product_kind","D")->sum("o_remainder_day");

		$data["orders"] = \App\Models\FrenchProductOrder::where("o_remainder",">",0)
		->where(function ($query) use ($request) {
			if ($request->q) {
					$query->where("o_member_name", "like", "%" . $request->q . "%");
						//->orwhere("o_title", "like", "%" . $request->q . "%")
			}
			if ($request->sdate) {
				$query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
			}
			if ($request->edate) {
				$query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
			}
		})
		->orderBy("o_no","desc")->paginate(10);

        $productType = Config::get('product.productType');

        foreach( $data["orders"] as $order ) {

            $order->o_product_name = $productType[$order->o_product_kind];

            if ( $order->o_product_kind == "A") {
                $order->o_duration_tail = "";
            } elseif ( $order->o_product_kind == "D") {
                $order->o_duration_tail = "일";
            } elseif ( $order->o_product_kind == "F") {
                $order->o_duration_tail = "개월";
            } elseif ( $order->o_product_kind == "T") {
                $order->o_duration_tail = "시간";
            }

        }

        $data['start'] = $data["orders"]->total() - $data["orders"]->perPage() * ($data["orders"]->currentPage() - 1);
        $data['total'] = $data["orders"]->total();
        $data['param'] = [
                'state' => $request->state, 
                'sdate' => $request->sdate, 
                'edate' => $request->edate, 
                'fd' => $request->fd, 
                'q' => $request->q];

		return view('partner.work.remaining_time',$data);

    }

  
}
