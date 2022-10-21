<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Models\FrenchRoom;
use App\Models\FrenchSeat;
use App\Models\FrenchReservSeat;
use Carbon\Carbon;

class FrenchMainController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $partner;

    public function __construct()
    {
        $this->partner = new Partner();
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchRoom = new FrenchRoom();   
        $this->FrenchReservSeat = new FrenchReservSeat();      
    }

    ## 목록
    public function main(Request $request){
        $data = [];
        $data['partner'] = \App\Models\Partner::where('p_id', $request->account)->first();


        // 존재하지 않는 경우
        if( !$data["partner"] ) {
            $data["message"] = "존재하지 않는 가맹점입니다.";
            return view('partner.errorpartner.error_door',$data);
        }

        // 차단의 경우경우
        if( $data["partner"]->p_state != "Y" ) {
            $data["message"] = "접근이 차단된 가맹점입니다.";
            return view('partner.errorpartner.error_door',$data);
        }

        // 기간이 종료된경우
        if( $data["partner"]->p_last_dt == "0000-00-00" ) {
            $data["message"] = "사용등록후 이용하실 수 있습니다.";
            return view('partner.errorpartner.error_door',$data);
        }

        if( $data["partner"]->p_last_dt <= date('Y-m-d') ) {
            $data["message"] = "사용기간이 종료되었습니다.";
            return view('partner.errorpartner.error_door',$data);
        }

        Config::set('database.connections.partner.database',"boss_".$request->account);

        if( $request->map  ) {
            $data["map"] =  \App\Models\FrenchMap::find($request->map);
        } else {
            $data["map"]  = \App\Models\FrenchMap::first();
        }  
        
        $data["rooms"] = $this->FrenchRoom->all();
        // $data["seats"] = $this->FrenchSeat->select(["french_seats.*", "r.r_no", "r.r_name", "sl.sl_no", "sl.sl_name"])
        // ->leftjoin('french_rooms as r', 'french_seats.s_room', '=', 'r.r_no')
        // ->leftjoin('french_seat_levels as sl', 'french_seats.s_level', '=', 'sl.sl_no');
        //->orderBy("french_seats.s_room","desc");
        $data["seats"] = $this->FrenchSeat->all();

        return view('partner.index', $data);
    }

    ## 현재 예약상태 가져오기
    public function seatState(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $FrenchReservSeat = new FrenchReservSeat;
        
        // 현재시간으로 부터 1시간이내 예약내역
        $sdate = Carbon::now()->format('Y-m-d H:i:s');
        $edate = Carbon::now()->addHours(1)->format('Y-m-d H:i:s');
        
        $data['result'] = false;
        $data['message'] = "$sdate $edate"; 

        $data['result'] = true;
        $data['rsvs'] = \App\Models\FrenchReservSeat::where("rv_sdate", "<", now())
        ->where("rv_edate", ">", now())
        ->where("rv_state_seat", '<>',  'END')
        ->get();

        // 전체 좌석수
        $data["count_seat"] = \App\Models\FrenchSeat::count();     
        
        // 현재 이용건수
        $data["count_used"] = \App\Models\FrenchReservSeat::where("rv_sdate", "<", now())
        ->where("rv_edate", ">", now())
        ->where("rv_state_seat", '<>',  'END')
        ->count();

        // 금일 총 이용건수
        $data["count_today_all"] = \App\Models\FrenchReservSeat::where(DB::raw("date_format(rv_sdate,'%Y-%m-%d')"), now()->format('Y-m-d'))
        ->where('rv_sdate', '<', now())
        ->where("rv_state_seat", '<>',  'END')
        ->count();  

        // 금일 모바일 이용건수
        $data["count_today_mobile"] = \App\Models\FrenchReservSeat::where(DB::raw("date_format(rv_sdate,'%Y-%m-%d')"), now()->format('Y-m-d'))
        ->where('rv_sdate', '<', now())
        ->where("rv_state_seat", '<>',  'END')
        ->where('rv_device_from', 'M')
        ->count();        

        //::
        //->where(DB::raw("rv_edate >= now()"))

        return response($data);
    } 

    ## 목록
    public function seatStatistics(Request $request){
        $data = [];
        $data['partner'] = \App\Models\Partner::where('p_id', $request->account)->first();

        Config::set('database.connections.partner.database',"boss_".$request->account);




        $data["seats"] = $this->FrenchSeat->all();

        return view('partner.index', $data);
    }    

}
