<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchRoom;
use App\Models\FrenchSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class SettingRoomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $FrenchRoom;

    public function __construct()
    {
        $this->FrenchRoom = new FrenchRoom();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["rooms"] = [];
        $data["rooms"] = $this->FrenchRoom->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("r_name", "like", "%" . $request->q . "%");
                    }
                }
                if ($request->state) {
                    if( $request->state == "A" ) {
                        $query->where("r_sdate",  ">", now());
                    } elseif( $request->state == "I" ) {
                        $query->where("r_sdate",  "<=", now());
                        $query->where("r_edate",  ">=", now());
                    }  elseif( $request->state == "E" ) {
                        $query->where("r_edate",  "<", now());
                    }
                }
            })
            ->orderBy("r_no","desc")->paginate(50);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["rooms"]->total() - $data["rooms"]->perPage() * ($data["rooms"]->currentPage() - 1);
        $data['total'] = $data["rooms"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];

        return view('partner.setting.room', $data);
    }



    ## 목록 위한 정보
    public function get_list(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["rooms"] = [];
        $data["rooms"] = $this->FrenchRoom->select("r_no","r_name","r_seat_count","r_state_mobile","r_state_kiosk","r_sex","r_type","r_iot1","r_iot2","r_iot3","r_iot4")
            ->orderBy("r_name","asc")->get();

        return response($data);

    }

    ## 폼을 위한 정보
    public function getInfo(Request $request){

            Config::set('database.connections.partner.database',"boss_".$request->account);

            $data["result"] = true;
            $data["room"] = $this->FrenchRoom->select(
                    [
                        'r_no as no',
                        'r_name as name',
                        'r_seat_count as seat_count',
                        'r_type as type',
                        'r_state_mobile as state_mobile',
                        'r_state_kiosk as state_kiosk',
                        'r_sex as sex',
                        'r_partner as partner',
                        'r_iot1 as iot1',
                        'r_iot2 as iot2',
                        'r_iot3 as iot3',
                        'r_iot4 as iot4'
                    ]
                )
                ->where("r_no",  $request->no)->first();
            return response($data);

    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $FrenchRoom = FrenchRoom::where('r_no', $request->no)->firstOrFail();
        } else {
            $FrenchRoom = new FrenchRoom();
        }

        $FrenchRoom->r_partner = $request->account ?? "";
        $FrenchRoom->r_name = $request->name ?? "";
        $FrenchRoom->r_type = $request->type ?? "";
        $FrenchRoom->r_seat_count = $request->seat_count ?? "";
        $FrenchRoom->r_sex = $request->sex ?? "";
        $FrenchRoom->r_state_mobile = $request->state_mobile ?? "N";
        $FrenchRoom->r_state_kiosk = $request->state_kiosk ?? "N";
        $FrenchRoom->r_iot1 = $request->iot1 ?? "";
        $FrenchRoom->r_iot2 = $request->iot2 ?? "";
        $FrenchRoom->r_iot3 = $request->iot3 ?? "";
        $FrenchRoom->r_iot4 = $request->iot4 ?? "";

        if( isset( $FrenchRoom->r_no ) ) {
            $result['result'] = $FrenchRoom->update();
        } else {
            $result['result'] = $FrenchRoom->save();
            //$FrenchRoom->r_no = $result['result'];
        }


        ## 현재해당 룸 좌석의 수가 설정 좌석수보다 적으면 이름없이 추가해줌..
        $FrenchSeatTmp = new FrenchSeat();        
        $seat_count = $FrenchSeatTmp->where("s_room",$FrenchRoom->r_no)->count();

        

        if( $FrenchRoom->r_seat_count > $seat_count ) {
            $new_seat_count = $FrenchRoom->r_seat_count - $seat_count;
            for( $i = 0; $i<=$new_seat_count-1; $i++ ) {
                $FrenchSeat = new FrenchSeat();        
                $FrenchSeat->s_partner = $request->account ?? "";
                $FrenchSeat->s_name = $request->name ? $request->name . " " . ($i+1) : ($FrenchSeat->s_no ?? '');
                $FrenchSeat->s_room = $FrenchRoom->r_no;
                $FrenchSeat->s_level = 0;
                $FrenchSeat->s_state = "Y";
                $FrenchSeat->s_open_mobile = $request->state_mobile ?? "Y";
                $FrenchSeat->s_open_mobile = $request->state_kiosk ?? "Y";
                $FrenchSeat->s_iot1 = "";
                $FrenchSeat->s_iot2 = "";
                $FrenchSeat->s_iot3 = "";
                $FrenchSeat->s_iot4 = "";
                $FrenchSeat->save();
            }

        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }


    public function delete(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $FrenchRoom = FrenchRoom::where('r_no', $request->no)->firstOrFail();

            if($FrenchRoom->delete()) {
                $result = ['result' => true];
            } else {
                $result = [
                    'result' => false,
                    'message' => "삭제되지 않았습니다."];
                return response($result);
            }
        } else {
            $result = [
                'result' => false,
                'message' => "정보가 존재하지 않습니다."];
            return response($result);
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }


}
