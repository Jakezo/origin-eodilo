<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $partner->p_homepage = $request->homepage ?? "";
        $partner->p_phone = $request->phone ?? "";
        $partner->p_bizno = $request->bizno ?? "";
        $partner->p_ceo = $request->ceo ?? "";
        $partner->p_email = $request->email ?? "";
        $partner->p_intro = $request->intro ?? "";

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
        $partner->p_road = $request->road ?? "";
        $partner->p_work_time = $request->work_time ?? "";
        $partner->p_work_close = $request->work_close ?? "";
        $partner->p_parking = $request->parking ?? "";
        $partner->p_keyword = $request->keyword ?? "";


        /* 가맹점이 수정할수 없음.

        $partner->p_id = $request->id;
        $partner->p_name = $request->name ?? "";
        if( $request->passwd ) $partner->p_passwd = $request->passwd ?? "";
        $partner->p_map_use = $request->map_use ?? "";
        $partner->p_seq = $request->seq ?? 0;
        $partner->p_memo = $request->memo ?? "";
        $partner->p_state = $request->state ?? "N";
        */

        $result["partner"] = $partner;
        $result['result'] = $partner->update();

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }



}
