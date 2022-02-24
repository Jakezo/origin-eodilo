<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PartnerCoupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->PartnerCoupon = new PartnerCoupon();
    }

    ## 목록
    public function index(Request $request){

        $data["coupons"] = [];
        $data["coupons"] = $this->PartnerCoupon
        ->select("partner_coupons.*", "partners.p_name")
            ->leftjoin('partners', 'c_partner', '=', 'partners.p_no')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "title" ) {
                        $query->where("c_title", "like", "%" . $request->q . "%");
                    }  elseif( $request->fd == "cont" ) {
                        $query->where("c_cont", "like", "%" . $request->q . "%");
                    } else {
                        $query->
                                where("c_title", "like", "%" . $request->q . "%")
                            ->orwhere("c_cont", "like", "%" . $request->q . "%");
                    }
                }
                if ($request->state) {

                    if( $request->state == "A" ) {
                        $query->where("c_sdate",  ">", now());
                    } elseif( $request->state == "I" ) {
                        $query->where("c_sdate",  "<=", now());
                        $query->where("c_edate",  ">=", now());
                    }  elseif( $request->state == "E" ) {
                        $query->where("c_edate",  "<", now());
                    }

                }
            })
            ->orderBy("c_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["coupons"]->total() - $data["coupons"]->perPage() * ($data["coupons"]->currentPage() - 1);
        $data['total'] = $data["coupons"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.coupon.coupon', $data);
    }

    public function update(Request $request)
    {

        $result = [];
        if( $request->no ) {
            $PartnerCoupon = \App\Models\PartnerCoupon::where('c_no', $request->no)->firstOrFail();
        } else {
            $PartnerCoupon = new PartnerCoupon();
        }

        $PartnerCoupon->c_partner = $request->partner ?? 0;
        $PartnerCoupon->c_sdate = $request->sdate ?? "";
        $PartnerCoupon->c_edate = $request->edate ?? "";
        $PartnerCoupon->c_type = $request->type ?? "P";
        $PartnerCoupon->c_value = $request->value ?? "";
        $PartnerCoupon->c_title = $request->title ?? "";
        $PartnerCoupon->c_cont = $request->cont ?? "";
        $PartnerCoupon->c_read = $request->read ?? "N";

        if( $PartnerCoupon->c_no ) {
            $result['result'] = $PartnerCoupon->update();
        } else {
            $result['result'] = $PartnerCoupon->save();
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
        $result = [];
        if( $request->no ) {
            $PartnerCoupon = \App\Models\PartnerCoupon::where('c_no', $request->no)->firstOrFail();
            if( $PartnerCoupon ) {
                $result['result'] = $PartnerCoupon->delete();
            } else {
                $result['result'] = false;
                $result['message'] = "쿠폰정보가 존재하지 않습니다.";
            }
        } else {
            $result['result'] = false;
            $result['message'] = "쿠폰정보가 존재하지 않습니다.";
        }
        return response($result);
    }    

    ## 폼을 위한 정보
    public function getInfo(Request $request){
        $data["result"] = true;
        $data["coupon"] = $this->PartnerCoupon->select(
                [
                    'c_no as no',
                    'c_type as type',
                    'c_sdate as sdate',
                    'c_edate as edate',
                    'c_title as title',
                    'c_cont as cont',
                    'c_partner as partner',
                    'p_name as partner_name',
                    'c_value as value'
                ]
            )
            ->leftjoin('partners', 'c_partner', '=', 'partners.p_no')
            ->where("c_no",  $request->no)->first();
        return response($data);
    }

    ## 폼을 위한 정보 - 사용자에서 사용할...
     public function view(Request $request){

         $data["result"] = true;
         if( $request->no ) {
             $data["coupon"] = $this->PartnerCoupon->select()->where("c_no",  $request->no)->first();

             if( !$data["coupon"] ) {
                 return redirect()->back()->withErrors(['alert', 'Updated!']);
             }

         } else {
             $data["coupon"] = [];
         }
         return view('admin.coupon.coupon_form.', $data);
     }

    # API.쿠폰목록
    public function coupon_list(Request $request){
        $data["coupons"] = [];
        if( $request->partner ) {
            $data["coupons"] = \App\Models\PartnerCoupon::where("c_partner", $request->partner)
                    ->where("c_sdate",  "<=", now())
                    ->where("c_edate",  ">=", now())->get();      

            if( !$data["coupons"] || !count($data["coupons"]) ) {
                $data["result"] = false;
                $data["message"] = "쿠폰이 존재하지 않습니다.";
            }
        } else  {
            $data["result"] = false;
            $data["message"] = "가맹점이 선택되지 않았습니다.";
        }
       
        return response($data);
      
        // return response($data);
    }   

}
