<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchRoom;
use App\Models\FrenchSeat;
use App\Models\FrenchIot;
use App\Models\FrenchMap;
use App\Models\FrenchConfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Storage;
use App\Http\Classes\NCPdisk;

class SettingMapController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $FrenchRoom;
    public $FrenchSeat;
    public $FrenchMap;

    public function __construct()
    {
        $this->FrenchConfig = new FrenchConfig();
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchRoom = new FrenchRoom();
        $this->FrenchIot = new FrenchIot();
        $this->FrenchMap = new FrenchMap();
    }

    ## 목록
    public function editor(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data = [];
        $data["seats"] = [];

        $NCPdisk = new NCPdisk;

        Config::set('database.connections.partner.database',"boss_".$request->account);
        
        if( !$this->FrenchMap->first() ) {
            $this->FrenchMap->m_name = "기본";
            $this->FrenchMap->save();
        }

        $data["map_arr"] = $this->FrenchMap->select("m_no","m_name")
        ->orderBy("m_name","asc")->get();


        if( $request->map ) {

            $data["map"] = $request->map;

            $this->FrenchMap = \App\Models\FrenchMap::find($request->map);

            if( $this->FrenchMap->m_bg ) {
                $data["bg_url"] = $NCPdisk->url($this->FrenchMap->m_bg);
            } else {
                $data["bg_url"] = "";
            }
            $data["bg_width"] = $this->FrenchMap->m_width;
            $data["bg_height"] = $this->FrenchMap->m_width;
        } else {
            $this->FrenchMap = \App\Models\FrenchMap::first();

            $data["map"] = $this->FrenchMap->m_no;
            if( $this->FrenchMap->m_bg ) {
                $data["bg_url"] = $NCPdisk->url($this->FrenchMap->m_bg);
            } else {
                $data["bg_url"] = "";
            }
        }

        $data["bg_width"] = $this->FrenchMap->m_width ?? 800;
        $data["bg_height"] = $this->FrenchMap->m_width ?? 600;


        // if( isset($request->room)  ) {
        //     $data["room"] = $this->FrenchRoom->select("r_no","r_name","r_bg")->find($request->room);
        // } else {
        //     $data["room"] = $this->FrenchRoom->select("r_no","r_name","r_bg")->orderby("r_no","desc")->limit(1)->first();
        // }

        // if( $data["room"] ) {
        //     $data["no"] = $data["room"]->r_no;
        //     if( $data["room"]->r_bg ) {

		// 	    list($data["bg_width"], $data["bg_height"] ) = getimagesize($NCPdisk->url($data["room"]->r_bg));
        //         $data["bg_url"] = $NCPdisk->url($data["room"]->r_bg);
        //     } else {
        //         $data["bg_url"] = "";
                
        //     }     
        // }
        
        return view('partner.setting.map_editor', $data);
    }

    ## 목록
    public function map_save(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $result = [];

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $mapData = json_decode($request->map_data,true);

        // $FrenchConfig = $this->FrenchConfig->first();
        
        // if( $FrenchConfig ) {
        //     $FrenchConfig->cf_bg = $map_data['bg']['src'] ?? "";
        //     $FrenchConfig->cf_bg_width = $map_data['bg']['width'] ?? 800;
        //     $FrenchConfig->cf_bg_height = $map_data['bg']['height'] ?? 600;
        //     $ll = $FrenchConfig->update();
        // } else {
        //     $FrenchConfig = new \App\Models\FrenchConfig;
        //     $FrenchConfig->cf_bg = $map_data['bg']['src'] ?? "";
        //     $FrenchConfig->cf_bg_width = $map_data['bg']['width'] ?? 800;
        //     $FrenchConfig->cf_bg_height = $map_data['bg']['height'] ?? 600;
        //     $FrenchConfig->save();
        // }

   

        // 배경이미지가 없는 경우만 사이즈 업데이트 
        if( $request->map ) {
            
            $this->FrenchMap = \App\Models\FrenchMap::find($request->map);
            if( !$mapData['bg']['src'] ) {
                $this->FrenchMap->m_width = $mapData['bg']['width'] ?? 800;
                $this->FrenchMap->m_height = $mapData['bg']['height'] ?? 600;
                $this->FrenchMap->update();
            }
        } else {
            if( !$mapData['bg']['src'] ) {
                $this->FrenchMap->m_name = "기본";          
                $this->FrenchMap->m_width = $mapData['bg']['width'] ?? 800;
                $this->FrenchMap->m_height = $mapData['bg']['height'] ?? 600;
                $this->FrenchMap->save();      
            }
            return response($result);  
        }
     

        foreach( $mapData['seats'] as $i => $seat_info ) {
            $seat = $this->FrenchSeat::where("s_no", $seat_info['s_no'])->first();
            $seat->s_map_x = $seat_info['pos_x'];         
            $seat->s_map_y = $seat_info['pos_y']; 
            $seat->s_map_w = $seat_info['size_w'];
            $seat->s_map_h = $seat_info['size_h'];
            $seat->s_map_r = $seat_info['rotate'];
            $seat->update();
        }
    

        $result = ['result' => true, "map" => $this->FrenchMap->m_no];
        return response($result);    

    }

    ## 목록
    public function map_bg_upload(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $result = [];

        Config::set('database.connections.partner.database',"boss_".$request->account);

        //$this->FrenchRoom = FrenchRoom::find($request->room);
        $NCPdisk = new NCPdisk;       

        //MAP
        $upload_res = $NCPdisk->upload("partner/".$request->account_no."/map", $request->bg);

        if( $upload_res['result'] ) {    
            $result['result'] = true; 
         
            if( $request->map ) {
                $this->FrenchMap = \App\Models\FrenchMap::find($request->map);   

                // 기존파일이 있다면 삭제
                if( $this->FrenchMap->m_bg ) {
                    Storage::disk('ncloud')->delete($this->FrenchMap->m_bg);
                }

                $this->FrenchMap->m_bg = $upload_res['filepath'] ?? "";
                //실제 이미지 사이즈를 저장하지 않습니다.
			    //list($this->FrenchMap->m_width, $this->FrenchMap->m_height ) = getimagesize($NCPdisk->url($upload_res['filepath']));

                // 에디터의 사이즈를 저장합니다.
                $this->FrenchMap->m_width = $request->width;
                $this->FrenchMap->m_height = $request->height;

                $this->FrenchMap->update();

                $result['bg'] = $this->FrenchMap;
            }               

        } else  {
            Storage::disk('ncloud')->delete($upload_res['filepath']);
            $result['result'] = false;
        }

        // ROOM
        //$upload_res = $NCPdisk->upload("partner/".$request->account_no."/room", $request->bg);
        /*
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
        */

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
            ->where(function ($query) use ($request) {
                // if ($request->room) {
                //         $query->where("r_no", $request->room);
                // }     
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
