<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchMember;
use App\Models\FrenchReservSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class FrenchProductOrderController extends Controller
{


    public function __construct()
    {
        $this->FrenchProductOrder = new FrenchProductOrder();
    }
 
    ## 저장
    public function buyProduct(Request $request)
    {      
        Config::set('database.connections.partner.database',"boss_".$request->account);        

        $FrenchProductOrder = new FrenchProductOrder;

        if( !$request->b_member ) {
            $result['result'] = false;
            $result['message'] = "회원정보가 없습니다."; 
    
            return response($result);
        }
        if( !$request->b_duration ) {
            $result['result'] = false;
            $result['message'] = "기간을 선택하지 않습니다."; 
    
            return response($result);
        }
        if( !$request->b_pay_kind ) {
            $result['result'] = false;
            $result['message'] = "결제 방법을 선택하지 않습니다."; 
    
            return response($result);
        }
        if( !$request->b_pay_state ) {
            $result['result'] = false;
            $result['message'] = "결제 여부를 선택하지 않습니다."; 
    
            return response($result);
        }
        if( !$request->b_price_total ) {
            $result['result'] = false;
            $result['message'] = "합계요금이 입력되지 않습니다."; 
    
            return response($result);
        }
        if( !$request->b_pay_money ) {
            $result['result'] = false;
            $result['message'] = "결제금액이 입력되지 않습니다."; 
    
            return response($result);
        }

        // if( !$request->b_device_from ) {
        //     $result['result'] = false;
        //     $result['message'] = "잘못된 디바이스 접근입니다."; 
    
        //     return response($result); 
        // }

        // 회원정보
        if( $FrenchMember = \App\Models\FrenchMember::where('mb_no', $request->b_member)->first() ){
            $FrenchProductOrder->o_member_name = $FrenchMember->mb_name; 
        } else {
            $result['result'] = false;
            $result['message'] = "해당 회원이 존재하지 않습니다."; 
    
            return response($result);
        }

        $FrenchProductOrder->o_partner = $request->account_no ?? 0;
        $FrenchProductOrder->o_member_from = "L";
        $FrenchProductOrder->o_member = $request->b_member; 

        $FrenchProductOrder->o_ageType = $request->b_ageType ?? ""; 
        $FrenchProductOrder->o_memo = $request->memo ?? ""; 
        $FrenchProductOrder->o_device_from = $request->b_device_from ?? "A"; 
        $FrenchProductOrder->o_seat_level = $request->b_seat_level ?? ""; 
        $FrenchProductOrder->o_product_kind = $request->b_product_kind ?? ""; 
        $FrenchProductOrder->o_duration = $request->b_duration ?? ""; 
        $FrenchProductOrder->o_remainder = $request->b_duration ?? ""; 
        $FrenchProductOrder->o_price_seat = $request->b_price_seat ?? 0;   
        
        //$FrenchProductOrder->o_room = $request->b_room ?? "";  
        $FrenchProductOrder->o_seat = $request->b_seat ?? ""; 
        $FrenchProductOrder->o_seat_name = $request->b_seat_name ?? ""; 

        if( $request->b_product_kind == "A" || $request->b_product_kind == "D"  ) {
           $FrenchProductOrder->o_remainder_day = $FrenchProductOrder->o_duration ?? 0;  
            $FrenchProductOrder->o_duration_type = "D"; 
        } else if( $request->b_product_kind == "T" ) {
            $FrenchProductOrder->o_remainder_time = $FrenchProductOrder->o_duration ?? 0;  
            $FrenchProductOrder->o_duration_type = "T"; 
        } else if( $request->b_product_kind == "P" ) {
            $FrenchProductOrder->o_remainder_point = $FrenchProductOrder->o_duration ?? 0;  
            $FrenchProductOrder->o_duration_type = "P"; 
        } else {
            $FrenchProductOrder->o_duration_type = ""; 
        }
        //$FrenchProductOrder->o_remainder_day = $request->b_remainder_day ?? ""; 

        //$FrenchProductOrder->o_sdate = "";  
        //$FrenchProductOrder->o_edate = ""; 

        if( $request->b_locker ) {
            $FrenchProductOrder->o_locker_use = "Y" ; 
        } else {
            $FrenchProductOrder->o_locker_use = "N" ; 
        }

        $FrenchProductOrder->o_locker = $request->b_locker ?? 0; 
        $FrenchProductOrder->o_locker_name = $request->b_locker_name ?? ''; 
        $FrenchProductOrder->o_price_locker = $request->b_price_locker ?? 0; 
        $FrenchProductOrder->o_price_total = $request->b_price_total ?? 0; // 총금액

        $FrenchProductOrder->o_pay_point = $request->b_pay_point ?? 0; 
        $FrenchProductOrder->o_pay_money = $request->b_pay_money ?? 0; // 실결제금액
        
        $FrenchProductOrder->o_pay_discount = $request->b_price_total - $request->b_pay_money;
        $FrenchProductOrder->o_pay_kind = $request->b_pay_kind ?? ""; 
        $FrenchProductOrder->o_pay_state = $request->b_pay_state ?? ""; 
        
        if( $FrenchProductOrder->o_pay_state == "Y" ) {
        $FrenchProductOrder->o_pay_at = Carbon::now()->toDateTimeString(); 
        }

        // $FrenchProductOrder->o_refund = $request->b_refund ?? ""; 
        // $FrenchProductOrder->o_refund_at = $request->b_refund_at ?? ""; 
        // $FrenchProductOrder->o_refund_price = $request->b_refund_price ?? ""; 
        // $FrenchProductOrder->o_refund_money = $request->b_refund_money ?? ""; 
        // $FrenchProductOrder->o_refund_memo = $request->b_refund_memo ?? "";
        
        $FrenchProductOrder->o_memo = $request->b_memo ?? ""; 

        $result['result'] = $FrenchProductOrder->save();
        if( $result['result'] ) {
            $result['no'] = $FrenchProductOrder->o_no; 
        } else {
            $result['message'] = "관리자에게 문의해주세요."; 
        }

        return response($result);

    }

    ## 등급목록
    public function setSeatLevel(Request $request)
    {      
        Config::set('database.connections.partner.database',"boss_".$request->account);        

        $FrenchProductOrder = new FrenchProductOrder;

        $FrenchProductOrder->o_memo = $request->b_memo ?? ""; 

        $result['result'] = $FrenchProductOrder->save();
        
        if( $result['result'] ) {
            $result['no'] = $FrenchProductOrder->o_no; 
        } else {
            $result['message'] = "관리자에게 문의해주세요."; 
        }

        return response($result);

    }

  
}
