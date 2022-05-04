<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\PartnerApply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class MobilePartnerApplyController extends Controller
{

    public function __construct()
    {
        $this->partner_apply = new PartnerApply();
    }

        ## 저장
        public function store(Request $request)
        { 
            
   
            $result = [];

            if( $request->no ) {
                $partner_apply = \App\Models\PartnerApply::where('app_no', $request->no)->firstOrFail();
            } else {
                $partner_apply = new PartnerApply;
            }

            $partner_apply->app_name = Auth::guard('user')->user()->id ?? "";
            $partner_apply->app_address = $request->app_address ?? "";
            $partner_apply->app_phone = $request->phone ?? "";
            $partner_apply->app_state = $request->state ?? "N";
            $partner_apply->app_title = $request->app_title ?? "";
            $result['result'] = $partner_apply->save();

             return view('mobile.request_shop_fin', $result);


        }


}
