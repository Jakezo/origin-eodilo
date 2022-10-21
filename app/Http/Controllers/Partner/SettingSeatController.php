<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchRoom;
use App\Models\FrenchSeat;
use App\Models\FrenchIot;
use App\Models\FrenchConfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Storage;
use App\Http\Classes\NCPdisk;

class SettingSeatController extends Controller
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
        $this->FrenchConfig = new FrenchConfig();
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchRoom = new FrenchRoom();
        $this->FrenchIot = new FrenchIot();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["iots"] = $this->FrenchIot->select(
            [
                'i_no as no',
                'i_name as name'
            ]
        )
        ->get();        

        $data["rooms"] = $this->FrenchRoom->select("r_no","r_name")
            ->orderBy("r_name","asc")->get();

        $data["rooms"] = $this->FrenchRoom->select("r_no","r_name")
            ->orderBy("r_name","asc")->get();
            
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
            ->orderBy("s_no","desc")->paginate(50);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["seats"]->total() - $data["seats"]->perPage() * ($data["seats"]->currentPage() - 1);
        $data['total'] = $data["seats"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
        return view('partner.setting.seat', $data);
    }


    ## 폼을 위한 정보
    public function getInfo(Request $request){

            Config::set('database.connections.partner.database',"boss_".$request->account);

            $data["result"] = true;
            $data["seat"] = $this->FrenchSeat->select(
                    [
                        's_no as no',
                        's_room as room',
                        's_name as name',
                        's_level as level',
                        's_state as state',
                        's_sex as sex',
                        's_age as age',
                        's_open_mobile as open_mobile',
                        's_open_kiosk as open_kiosk',
                        's_iot1 as iot1',
                        's_iot2 as iot2',
                        's_iot3 as iot3',
                        's_iot4 as iot4',
                        's_iot_ext as iot_ext'
                    ]
                )
                ->where("s_no",  $request->no)->first();
            return response($data);

    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $result = [];
        if( $request->no ) {
            $FrenchSeat = FrenchSeat::where('s_no', $request->no)->firstOrFail();
        } else {
            $FrenchSeat = new FrenchSeat();
        }

        //$FrenchSeat->s_partner = $request->account ?? "";
        $FrenchSeat->s_name = $request->name ?? "";
        $FrenchSeat->s_room = $request->room ?? 0;
        $FrenchSeat->s_level = $request->level ?? 0;
        $FrenchSeat->s_state = $request->state ?? "N";
        $FrenchSeat->s_age = $request->age ?? "";
        $FrenchSeat->s_sex = $request->sex ?? "A";
        $FrenchSeat->s_open_mobile = $request->open_mobile ?? "N";
        $FrenchSeat->s_open_kiosk = $request->open_kiosk ?? "N";
        $FrenchSeat->s_iot1 = $request->iot1 ?? "";
        $FrenchSeat->s_iot2 = $request->iot2 ?? "";
        $FrenchSeat->s_iot3 = $request->iot3 ?? "";
        $FrenchSeat->s_iot4 = $request->iot4 ?? "";
        $FrenchSeat->s_iot_ext = $request->iot_ext ? implode(",",$request->iot_ext) : "";

        

        if( isset( $FrenchSeat->s_no ) ) {
            $result['result'] = $FrenchSeat->update();
        } else {
            $result['result'] = $FrenchSeat->save();
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
            $FrenchSeat = FrenchSeat::where('s_no', $request->no)->firstOrFail();

            if($FrenchSeat->delete()) {
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

    public function changeLevel(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        Config::set('database.connections.partner.database',"boss_".$request->account);

        
        $result = [];
        $change_seat = 0;
        if( $request->s_arr ) {
            for( $i = 0 ; $i <= count($request->s_arr)-1; $i++ ) {
                if( $FrenchSeat = FrenchSeat::where('s_no', $request->s_arr[$i])->firstOrFail() ) {
                    if( $request->change_lv ) $FrenchSeat->s_level =  $request->change_lv;
                    if( $request->change_room  ) $FrenchSeat->s_room =  $request->change_room;

                    if( $FrenchSeat->update() ) {
                        $change_seat++;
                    }
                }
            }
        } 
        if( $change_seat > 0  ) {
            $result['result'] = true;
            $result['message'] = $change_seat . "건의 좌석이 변경되었습니다.";
        } else {
            $result['result'] = false;
            $result['message'] = "변경된 좌석이 없습니다.";
        }
        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    ## 목록
    public function editor(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data = [];
        $data["seats"] = [];

        $NCPdisk = new NCPdisk;

        Config::set('database.connections.partner.database',"boss_".$request->account);
        
        $data["room_arr"] = $this->FrenchRoom->select("r_no","r_name")
        ->orderBy("r_name","asc")->get();


        if( isset($request->room)  ) {
            $data["room"] = $this->FrenchRoom->select("r_no","r_name","r_bg")->find($request->room);
        } else {
            $data["room"] = $this->FrenchRoom->select("r_no","r_name","r_bg")->orderby("r_no","desc")->limit(1)->first();
        }

        if( $data["room"] ) {
            $data["no"] = $data["room"]->r_no;
            if( $data["room"]->r_bg ) {
                $data["bg_url"] = $NCPdisk->url($data["room"]->r_bg);
            } else {
                $data["bg_url"] = "";
                
            }     
            
            //아래는 자바스크립트에서 ajax 로 로드하기 때문에 제외합니다.
            // $data["seats"] = $this->FrenchSeat->select(["french_seats.*", "r.r_no", "r.r_name", "sl.sl_no", "sl.sl_name"])
            // ->leftjoin('french_rooms as r', 'french_seats.s_room', '=', 'r.r_no')
            // ->leftjoin('french_seat_levels as sl', 'french_seats.s_level', '=', 'sl.sl_no')
            // ->where(function ($query) use ($request) {

            //     if ($request->room) {
            //             $query->where("r_no", $request->room);
            //     }                

            //     if ($request->q) {
            //         if( $request->fd == "name" ) {
            //             $query->where("s_name", "like", "%" . $request->q . "%");
            //         }
            //     }
            //     if ($request->state) {
            //         if( $request->state == "A" ) {
            //             $query->where("s_sdate",  ">", now());
            //         } elseif( $request->state == "I" ) {
            //             $query->where("s_sdate",  "<=", now());
            //             $query->where("s_edate",  ">=", now());
            //         }  elseif( $request->state == "E" ) {
            //             $query->where("s_edate",  "<", now());
            //         }
            //     }
            // })
            // ->orderBy("s_no","desc");
        }


        return view('partner.setting.seat_editor', $data);
    }

    ## 목록
    public function map_save(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $map_data = json_decode($request->map_data,true);

        $result = [];
        $result = ['result' => true];

        $FrenchConfig = $this->FrenchConfig->first();
        if( $FrenchConfig ) {
            $FrenchConfig->cf_bg = $map_data['bg']['src'] ?? "";
            $FrenchConfig->cf_bg_width = $map_data['bg']['width'] ?? 800;
            $FrenchConfig->cf_bg_height = $map_data['bg']['height'] ?? 600;
            $ll = $FrenchConfig->update();
        } else {
            $FrenchConfig = new \App\Models\FrenchConfig;
            $FrenchConfig->cf_bg = $map_data['bg']['src'] ?? "";
            $FrenchConfig->cf_bg_width = $map_data['bg']['width'] ?? 800;
            $FrenchConfig->cf_bg_height = $map_data['bg']['height'] ?? 600;
            $FrenchConfig->save();
        }

        foreach( $map_data['seats'] as $i => $seat_info ) {
            $seat = $this->FrenchSeat::where("s_no", $seat_info['s_no'])->first();
            $seat->s_map_x = $seat_info['pos_x'];         
            $seat->s_map_y = $seat_info['pos_y']; 
            $seat->s_map_w = $seat_info['size_w'];
            $seat->s_map_h = $seat_info['size_h'];
            $seat->s_map_r = $seat_info['rotate'];
            $seat->update();
        }
        return response($result); 
    }

    ## 목록
    public function map_bg_upload(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $this->FrenchRoom = FrenchRoom::find($request->room);

        $result = [];
        
        $NCPdisk = new NCPdisk;
        
        $upload_res = $NCPdisk->upload("partner/".$request->account_no."/room", $request->bg);

        //$upload_res = Storage::disk('ncloud')->put($save_filename,$file_contents);
        if( $upload_res['result'] ) {    
            $result['result'] = true;
            $this->FrenchRoom->r_bg = $upload_res['filepath'];
            if( $res = $this->FrenchRoom->update() ) {
                $result["src"] = $NCPdisk->url($upload_res['filepath']);
            } else {
                $result['result'] = false;
            }

        } else  {
            Storage::disk('ncloud')->delete($upload_res['filepath']);
            $result['result'] = false;
        }
        return response($result); 
    }


    ## 목록
    public function editor_getMapInfo(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);
        $FrenchConfig = $this->FrenchConfig->select(["cf_bg as src", "cf_bg_width as width", "cf_bg_height as height"])->first();

        if( $FrenchConfig ) {
            $data["bg"] = $FrenchConfig;
        } else {
            $data["bg"] = [];
        }

        $data["rooms"] = $this->FrenchRoom->select("r_no","r_name")
            ->orderBy("r_name","asc")->get();

            if( $data["rooms"][0] ) {
                $data["no"] = $data["rooms"][0]->r_no;
                //$data["bg_url"] = ""; // 좌석이미지
            } else {
                $data["no"] = "";
            }

        $data["seats"] = [];
        $data["seats"] = $this->FrenchSeat->select(["french_seats.*", "r.r_no", "r.r_name", "sl.sl_no", "sl.sl_name"])
        ->leftjoin('french_rooms as r', 'french_seats.s_room', '=', 'r.r_no')
        ->leftjoin('french_seat_levels as sl', 'french_seats.s_level', '=', 'sl.sl_no')
        ->where("french_seats.rv_state_seat","<>","END")
            ->where(function ($query) use ($request) {
                if ($request->room) {
                        $query->where("r_no", $request->room);
                }     
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

}
