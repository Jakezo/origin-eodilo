<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\FrenchConfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
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
        $this->FrenchConfig = new FrenchConfig();
    }

    ## 목록
    public function info(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data = [];
        $data['partner'] = \App\Models\Partner::where('p_id', $request->account)->first();


        // 정상의 경우
        return view('partner.setting.info', $data);
    }

    public function info_update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());
        $result = [];
        if( $request->account ) {
            $partner = \App\Models\Partner::where('p_id', $request->account)->firstOrFail();
        } else {
            $partner = new Partner();
        }

        /* 시스템에서만 수정
        $partner->p_id = $request->id;
        $partner->p_name = $request->name ?? "";
        if( $request->passwd ) $partner->p_passwd = $request->passwd ?? "";
        $partner->p_map_use = $request->map_use ?? "";
        $partner->p_seq = $request->seq ?? 0;
        $partner->p_memo = $request->memo ?? "";
        $partner->p_state = $request->state ?? "N";

        $partner->p_homepage = $request->homepage ?? "";
        $partner->p_phone = $request->phone ?? "";
        $partner->p_bizno = $request->bizno ?? "";
        $partner->p_ceo = $request->ceo ?? "";
        $partner->p_email = $request->email ?? "";

        $partner->p_emp_name = $request->emp_name ?? "";
        $partner->p_emp_duty = $request->emp_duty ?? "";
        $partner->p_emp_email = $request->emp_email ?? "";
        $partner->p_emp_hphone = $request->emp_hphone ?? "";
        $partner->p_zipcode = $request->zipcode ?? "";
        $partner->p_address1 = $request->address1 ?? "";
        $partner->p_address2 = $request->address2 ?? "";

        $partner->p_map_use = $request->map_use ?? "";
        $partner->p_map_latitude = $request->map_latitude ?? 0;
        $partner->p_map_longitude = $request->map_longitude ?? 0;
        */
        $partner->p_intro = $request->intro ?? "";

        $partner->p_road = $request->road ?? "";
        $partner->p_work_time = $request->work_time ?? "";
        $partner->p_work_close = $request->work_close ?? "";
        $partner->p_parking = $request->parking ?? "";
        $partner->p_keyword = $request->keyword ?? "";
        $partner->p_deadline_time = $request->deadline_time ?? "00:00:00";

        $result["partner"] = $partner;
        $result['result'] = $partner->update();

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    ## 목록
    public function iot(Request $request){
        $data["iots"] = [];
        //DB::enableQueryLog();	//query log 시작 선언부
        Config::set('database.connections.partner.database',"boss_".$request->account);
        $data["config"] = $this->FrenchConfig->first();
        return view('partner.setting.iot',$data);
    }


    ## 검색
    public function searchLocker(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["lockers"] = $this->FrenchLocker->select(["french_lockers.*", "la.la_no", "la.la_name"])
        ->leftjoin('french_locker_areas as la', 'french_lockers.l_area', '=', 'la.la_no')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("l_name", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("l_no","desc")->get();

        return response($data);
    }
    

}
