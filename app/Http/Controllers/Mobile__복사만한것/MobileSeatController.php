<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\FrenchRoom;
use App\Models\FrenchSeat;
use App\Models\FrenchConfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Classes\NCPdisk;

class MobileSeatController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $FrenchRoom;
    public $FrenchSeat;

    public function __construct()
    {
        $this->partner = new Partner();
        $this->FrenchConfig = new FrenchConfig();
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchRoom = new FrenchRoom();
    }


    ## 폼을 위한 정보
    public function getInfo(Request $request){

            Config::set('database.connections.partner.database',"boss_".$request->account);

            $data["result"] = true;
            $data["seat"] = $this->FrenchSeat->select(
                    [
                        's_no as no',
                        's_name as name',
                        's_level as level',
                        's_state as state',
                        's_open_mobile as open_mobile',
                        's_open_kiosk as open_kiosk',
                        's_iot1 as iot1',
                        's_iot2 as iot2',
                        's_iot3 as iot3',
                        's_iot4 as iot4'
                    ]
                )
                ->where("s_no",  $request->no)->first();
            return response($data);

    }

    ## 목록
    public function editor_getMapInfo(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $NCPdisk = new NCPdisk;

        $this->partner = Partner::where("p_no",  $request->p_no)->firstOrFail();
        Config::set('database.connections.partner.database',"boss_".$this->partner->p_id);

        $FrenchConfig = $this->FrenchConfig->select(["cf_bg as src", "cf_bg_width as width", "cf_bg_height as height"])->first();

        if( $FrenchConfig ) {
            $data["bg"] = $FrenchConfig;
        } else {
            $data["bg"] = [];
        }

        $data["rooms"] = $this->FrenchRoom->select("r_no","r_name","r_bg")
            ->orderBy("r_name","asc")->get();

            if( $data["rooms"][0] ) {
                $data["no"] = $data["rooms"][0]->r_no;
                if( $data["rooms"][0]->r_bg ) $data["bg_url"] = $NCPdisk->url($data["rooms"][0]->r_bg);
                else $data["bg_url"] = "";
            } else {
                $data["no"] = "";
                $data["bg_url"] = "";
            }

        $data["seats"] = [];
        $data["seats"] = $this->FrenchSeat->select(["french_seats.*", "r.r_no", "r.r_name", "sl.sl_no", "sl.sl_name"])
        ->leftjoin('french_rooms as r', 'french_seats.s_room', '=', 'r.r_no')
        ->leftjoin('french_seat_levels as sl', 'french_seats.s_level', '=', 'sl.sl_no')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("s_name", "like", "%" . $request->q . "%");
                    }
                }
                if ($request->state) {
                    if( $request->state == "A" ) {
                        $query->where("s_sdate",  ">", now());
                    } elseif( $request->state == "I" ) {
                        $query->where("s_sdate",  "<=", now());
                        $query->where("s_edate",  ">=", now());
                    }  elseif( $request->state == "E" ) {
                        $query->where("s_edate",  "<", now());
                    }
                }
            })
            ->orderBy("s_no","desc")->get();

        return response($data);
    }


    ## 선택된 날자의 좌석가능여부
    public function reserveSeatState(Request $request)
    {
        $data = [];
        //DB::enableQueryLog();	//query log 시작 선언부

        $this->partner = Partner::where("p_no",  $request->p_no)->firstOrFail();
        Config::set('database.connections.partner.database',"boss_".$this->partner->p_id);

        if( !$request->b_sdate ) $request->b_sdate = date("Y-m-d");
        if( !$request->b_stime ) $request->b_stime = date("H:i");

        if( $request->b_sdate && $request->b_stime )  {
            $r_sdt = Carbon::createFromFormat('Y-m-d H:i', $request->b_sdate . " " . $request->b_stime );
            $r_edt = $r_sdt->addHour(2);
        }

        $sdt = $r_sdt->format("Y-m-d H:i:s");
        $edt = $r_edt->format("Y-m-d H:i:s");

        $data["rooms"] = $this->FrenchRoom->select("r_no","r_name")
            ->orderBy("r_name","asc")->get();

            if( $data["rooms"][0] ) {
                $data["no"] = $data["rooms"][0]->r_no;
                //$data["bg_url"] = ""; // 좌석이미지
            } else {
                $data["no"] = "";
            }

        $data["result"] = true;
        $data["seats"] = [];
        $data["seats"] = $this->FrenchSeat->select(
                [
                    "french_seats.s_no", "french_seats.s_name", "french_seats.s_room", "french_seats.s_level", "french_seats.s_state",
                    "reserv_seats.*",
                    "r.r_no", "r.r_name"
                ]
        )
        ->leftJoin(DB::raw("
            (select rv_no, rv_seat, rv_member from french_reserv_seats where
            (rv_sdate <= '".$sdt."' and rv_edate >= '".$sdt."')
            or
            (rv_sdate <= '".$edt."' and rv_edate >= '".$edt."') ) as reserv_seats "), "reserv_seats.rv_seat" , "=", "french_seats.s_no")

        ->leftjoin('french_rooms as r', 'french_seats.s_room', '=', 'r.r_no')
        ->whereNotNull("reserv_seats.rv_no")
          ->orderBy("french_seats.s_no","desc")->get();

        return response($data);

    }


        ## 선택된 날자의 좌석가능여부
        public function reserveSeatStateChange(Request $request)
        {
            //DB::enableQueryLog();	//query log 시작 선언부

            $this->partner = Partner::where("p_no",  $request->p_no)->firstOrFail();
            Config::set('database.connections.partner.database',"boss_".$this->partner->p_id);


            $r_sdt = Carbon::createFromFormat('Y-m-d H:i', $request->b_sdate . " " . $request->b_stime );
            $r_edt = Carbon::createFromFormat('Y-m-d H:i', $request->b_edate . " " . $request->b_etime );


            $data["rooms"] = $this->FrenchRoom->select("r_no","r_name")
                ->orderBy("r_name","asc")->get();

                if( $data["rooms"][0] ) {
                    $data["no"] = $data["rooms"][0]->r_no;
                    //$data["bg_url"] = ""; // 좌석이미지
                } else {
                    $data["no"] = "";
                }

            $data["result"] = true;
            $data["seats"] = [];
            $data["seats"] = $this->FrenchSeat->select(
                    [
                        "french_seats.s_no", "french_seats.s_name", "french_seats.s_room", "french_seats.s_level", "french_seats.s_state",
                        "reserv_seats.*",
                        "r.r_no", "r.r_name"
                    ]
            )
            ->leftJoin(DB::raw("
                (select rv_no, rv_seat, rv_member from french_reserv_seats where
                (rv_sdate <= '".$r_sdt."' and rv_edate >= '".$r_sdt."')
                or
                (rv_sdate <= '".$r_edt."' and rv_edate >= '".$r_edt."') ) as reserv_seats "), "reserv_seats.rv_seat" , "=", "french_seats.s_no")

            ->leftjoin('french_rooms as r', 'french_seats.s_room', '=', 'r.r_no')
            ->whereNotNull("reserv_seats.rv_no")
              ->orderBy("french_seats.s_no","desc")->get();

            return response($data);

        }

}
