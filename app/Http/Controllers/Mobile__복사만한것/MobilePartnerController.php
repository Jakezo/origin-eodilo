<?php
namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Partner;
use App\Models\FrenchSeat;
use App\Models\FrenchSeatLevel;
use App\Models\FrenchLocker;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\Partner_review;
use App\Models\PartnerPhoto;
use App\Models\PartnerCoupon;
use App\Models\UserCoupon;

use App\Models\MobileProductOrder;
use App\Models\MobileReservSeat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Classes\NCPdisk;

class MobilePartnerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $partner;

    public function __construct(Request $request)
    {
        $this->partner = new Partner();
        $this->FrenchSeat = new FrenchSeat();
        $this->Partner_review = new Partner_review();
        $this->PartnerCoupon = new PartnerCoupon();

        // 기본정보 얻기
        $this->basicInfo($request->p_no);
    }


    ## 가맹점상세정보
    public function info(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["result"] = true;
        if( $request->p_no ) {
            $data['partner'] = Partner::where("p_no",  $request->p_no)->first();
        } else {
            $data["result"] = false;
            $data["message"] = "존재하지 않는 가맹점입니다.";
        }

        // $user_id = Auth::guard('user')->user()->id ?? 0;

        if( Auth::guard('user')->check() ){
            $data["fv"] = \App\Models\Partner_favorite::select("fv_no")->where('fv_partner', $request->p_no)
            ->where('fv_user', Auth::guard('user')->user()->id)
            ->first();
        }

        $partner = Partner::select("p_id")->where("p_no",  $request->p_no)->first();
        Config::set('database.connections.partner.database',"boss_".$partner->p_id);

        $data['seats'] = $this->FrenchSeat->select(DB::Raw('count(*) as count' ))
        ->where("s_partner",  $request->p_no)
        ->first();
        $data['emptyseats'] = $this->FrenchSeat->select(DB::Raw('count(*) as count' ))
        ->where("s_partner",  $request->p_no)
        ->where("s_state", "Y")
        ->first();


        // $data['empty_seats'] = $this->FrenchSeat->select(DB::Raw('count(*) as count' ))
        // ->where("s_open_mobile", "Y")->first();
        $data['reviews']= $this->Partner_review->select(DB::Raw('count(*) as count'))
        ->where("rv_partner",  $request->p_no)
        ->first();

        // $partner['option_cont'] = json_decode($partner->p_option_cont);

        $photos_arr = \App\Models\PartnerPhoto::select("pt_no", "pt_kind", "pt_filename")->where("pt_partner", $request->p_no)
        // ->where("pt_kind", $request->kind)
        ->orderBy("pt_seq")->get();

        $NCPdisk = new NCPdisk;

        foreach( $photos_arr as $photo ) {
            if( $photo->pt_filename ) {
                $photo->pt_filename =$NCPdisk->url($photo->pt_filename);

                // 종류별로 배열을 만든다.
                $data['photos'][$photo->pt_kind][] = $photo;
            }
        }



        $data["coupons"] = [];
        if( isset( Auth::guard('user')->user()->id) ) {
            $data["coupons"] = $this->PartnerCoupon->select('c_no','c_partner','uc_no','uc_used','c_title','c_cont', 'c_emp','c_sdate','c_edate','c_type','c_value')
            ->leftjoin('user_coupons',function($join) {
                $join->on('uc_coupon','=','partner_coupons.c_no')
                ->where('uc_user',  Auth::guard('user')->user()->id  ?? "");
            })
            ->where("c_partner", $request->p_no)
            ->where("c_sdate",  "<=", now())
            ->where("c_edate",  ">=", now())
            ->orderBy("c_no","desc")->paginate(10);
        }
        $data["exist_new_coupon"] = false;
        foreach( $data["coupons"] as $coupon ) {
            if( $coupon->uc_no == null || $coupon->uc_no == "" ) {
                $data["exist_new_coupon"] = true;
            }
        }

        //dd($data["coupons"]);

            ##visit count
            if(isset (Auth::guard('user')->user()->id)){

                if( $visit = \App\Models\Partner_view::where('v_partner', $request->p_no)
                ->where('v_user', Auth::guard('user')->user()->id)
                ->first() ) {
                    $visit->v_count++;
                    $data["result"] = $visit->update();
                    $data["v_no"] = $visit->v_no;
                    $data["v_time"] = \Carbon\Carbon::instance($visit->updated_at)->format('Y-m-d H:i:s');
                } else {
                    $visit = new \App\Models\Partner_view;
                    $visit->v_partner = $request->p_no;
                    $visit->v_user = Auth::guard('user')->user()->id;
                    $visit->v_count++;
                    $data["result"] = $visit->save();
                    $data["v_no"] = $visit->v_no;
                    $data["v_time"] = \Carbon\Carbon::instance($visit->updated_at)->format('Y-m-d H:i:s');
                }
            }
        return view('mobile.detail',$data);
    }

    ## 가맹점상세정보
    public function basicInfo($p_no){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["result"] = true;

        if( $p_no ) {
            $this->partner = Partner::where("p_no",  $p_no)->first();
        } else {
            return false;
        }

        return $data;
    }


}
