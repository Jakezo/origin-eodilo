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

class PartnerCouponController extends Controller
{
    public function __construct()
    {
        $this->PartnerCoupon = new PartnerCoupon();
    }

    ## 목록
    public function index(Request $request){

        $data["partner"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

        $data["coupons"] = [];
        $data["coupons"] = $this->PartnerCoupon->select()
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

        return view('partner.coupon.coupon_list', $data);
    }

    public function update(Request $request)
    {

        $result = [];
        if( $request->no ) {
            $PartnerCoupon = \App\Models\PartnerCoupon::where('c_no', $request->no)->firstOrFail();
        } else {
            $PartnerCoupon = new PartnerCoupon();
        }

        $PartnerCoupon->c_partner = $request->account_no ?? 0;
        $PartnerCoupon->c_emp = Auth::guard("partner")->user()->mn_no ?? "";
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
                    'c_value as value'
                ]
            )
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


    # API.쿠폰받기
    public function coupon_info(Request $request){

        if( $request->coupon ) {
            $data["result"] = false;
            $data["coupon"] = \App\Models\PartnerCoupon::where("c_partner", $request->partner)
                    ->where('c_no', $request->coupon)
                    ->where("c_sdate",  "<=", now())
                    ->where("c_edate",  ">=", now())->first(); 
            if( $data["coupon"] ) {
                $data["result"] = true;
            } else {
                $data["result"] = false;
                $data["message"] = "존재하지 않는 쿠폰입니다.";  
            }
        } else {
            $data["result"] = false;
            $data["message"] = "쿠폰이 선택되지 않았습니다.";
        }        

        return response($data);

       
        // return response($data);
    } 

    # API.쿠폰받기
    public function coupon_bring(Request $request){

        if( $request->coupon == "ALL") {
            $coupons =  $this->PartnerCoupon->where("c_partner", $request->partner)
                     ->where("c_sdate",  "<=", now())
                     ->where("c_edate",  ">=", now())->get();
        } else {
            $coupons = $this->PartnerCoupon->where("c_partner", $request->partner)
                    ->where('c_no', $request->coupon)
                    ->where("c_sdate",  "<=", now())
                    ->where("c_edate",  ">=", now())->get();            
        }

        $data["success"] = $data["fail"] = 0;
        $userId = 7;
        foreach ( $coupons as $ci => $coupon ) {

            if( $mycoupon = \App\Models\UserCoupon::where('uc_partner', $coupon->c_partner)
            ->where('uc_user', $userId)
            ->where('uc_coupon', $request->coupon)
            ->first() ) {
                if( $mycoupon->uc_used == "Y" ) {
                    $data["message"][$ci] = "이미 사용한 쿠폰입니다.";
                } else {
                    $data["message"][$ci] = "이미 소유한 쿠폰입니다.";
                }
                continue;
            } else {
                $mycoupon = new \App\Models\UserCoupon;
                $mycoupon->uc_user = $userId;
                $mycoupon->uc_partner = $request->partner;
                $mycoupon->uc_coupon = $request->coupon;

                $data["coupon_result"][$ci] = $mycoupon->save();
                if( $data["coupon_result"][$ci] ) {
                    $data["success"]++;
                    $data["new_no"][$ci] = $mycoupon->uc_no;
                    $data["message"][$ci] = "저장하였습니다.";
                } else {
                    $data["new_no"][$ci] = $mycoupon->uc_no;
                    $data["fail"]++;
                    $data["message"][$ci] = "실패하였습니다.";
                }

            }  
        }

        if( $data["success"] > 0 ) $data["result"] = true;
        else  $data["result"] = false;
       
        return response($data);

       
        // return response($data);
    }     

}
