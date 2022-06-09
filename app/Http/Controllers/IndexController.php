<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\MobileReservSeat;
use App\Models\Custom;
use App\Models\PartnerApply;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {

    }

    ## 목록
    public function index(Request $request){

        ## 회원통계
        $data["users"]["count_total"] = \App\Models\User::count() ?? 0;
        $data["users"]["count_today"] = \App\Models\User::whereDate("created_at",date('Y-m-d') )->count() ?? 0;
        $data["users"]["count_month"] = \App\Models\User::whereYear("created_at",date('Y') )->whereMonth("created_at",date('m') )->count() ?? 0;

        ## 이용내역
        $data["reserves"]["count_total"] = \App\Models\MobileReservSeat::count() ?? 0;
        $data["reserves"]["count_today"] = \App\Models\MobileReservSeat::whereDate("rv_sdate",date('Y-m-d') )->count() ?? 0;
        $data["reserves"]["count_month"] = \App\Models\MobileReservSeat::whereYear("rv_sdate",date('Y') )->whereMonth("rv_sdate",date('m') )->count() ?? 0;

        ## 고객문의
        $data["customs"]["count_total"] = \App\Models\Custom::count() ?? 0;
        $data["customs"]["count_today"] = \App\Models\Custom::whereDate("created_at",date('Y-m-d') )->count() ?? 0;
        $data["customs"]["count_month"] = \App\Models\Custom::whereYear("created_at",date('Y') )->whereMonth("created_at",date('m') )->count() ?? 0;
        $data["customs"]["data"] = \App\Models\Custom::orderByDesc("created_at")->limit(3)->get();    
        
        ## 가맹점문의
        $data["custom2s"]["data"] = \App\Models\Custom2::orderByDesc("created_at")->limit(3)->get();      


        ## 가맹점신청
        $data["partner_apply"]["count_total"] = \App\Models\PartnerApply::count() ?? 0;
        $data["partner_apply"]["count_today"] = \App\Models\PartnerApply::whereDate("created_at",date('Y-m-d') )->count() ?? 0;
        $data["partner_apply"]["count_month"] = \App\Models\PartnerApply::whereYear("created_at",date('Y') )->whereMonth("created_at",date('m') )->count() ?? 0;
        $data["partner_apply"]["data"] = \App\Models\PartnerApply::orderByDesc("created_at")->limit(3)->get();

        ## 가맹점신청
        
        return view('admin.index' , $data);

    }
    ## 목록
    public function index2(Request $request){
        return view('admin.index2');
    }

}
