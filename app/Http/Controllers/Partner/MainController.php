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

class MainController extends Controller
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
    }

    ## 목록
    public function main(Request $request){
        $data = [];
        $data['partner'] = \App\Models\Partner::where('p_id', $request->account)->first();


        // 존재하지 않는 경우
        if( !$data["partner"] ) {
            $data["message"] = "존재하지 않는 파트너입니다.";
            return view('partner.errorpartner.error_door',$data);
        }

        // 차단의 경우경우
        if( $data["partner"]->p_state != "Y" ) {
            $data["message"] = "접근이 차단된 파트너입니다.";
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


        $data["rooms"] = $this->FrenchRoom->all();
        // $data["seats"] = $this->FrenchSeat->select(["french_seats.*", "r.r_no", "r.r_name", "sl.sl_no", "sl.sl_name"])
        // ->leftjoin('french_rooms as r', 'french_seats.s_room', '=', 'r.r_no')
        // ->leftjoin('french_seat_levels as sl', 'french_seats.s_level', '=', 'sl.sl_no');
        //->orderBy("french_seats.s_room","desc");
        $data["seats"] = $this->FrenchSeat->all();

        return view('partner.index', $data);
    }

    ## 목록
    public function seatState(Request $request){
        $data = [];
        $data['partner'] = \App\Models\Partner::where('p_id', $request->account)->first();

        // 존재하지 않는 경우
        if( !$data["partner"] ) {
            $data["message"] = "존재하지 않는 파트너입니다.";
            return view('partner.errorpartner.error_door',$data);
        }

        // 차단의 경우경우
        if( $data["partner"]->p_state != "Y" ) {
            $data["message"] = "접근이 차단된 파트너입니다.";
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

        $data["seats"] = $this->FrenchSeat->all();

        return view('partner.index', $data);
    }

}
