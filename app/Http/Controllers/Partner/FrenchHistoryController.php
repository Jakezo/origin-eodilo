<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\MobileReservSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class FrenchHistoryController extends Controller
{


    public function __construct()
    {
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();        
    }
    
    ## 목록
    public function order_list(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["orders"] = [];
        $data["orders"] = $this->FrenchProductOrder
        ->where(function ($query) use ($request) {
            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }
            if ($request->sdate) {
                $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }
            if ($request->edate) {
                $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

            if ($request->pkind) {
                    $query->where("o_product_kind", $request->pkind);
            }            

            //  if ($request->state) {
            //     if( $request->state == "A" ) {
            //         $query->where("o_duration", "<", "%" . $request->q . "%");
            //     } elseif( $request->state == "N" ) {
            //         $query->where("e_title", "like", "%" . $request->q . "%");
            //     }  elseif( $request->state == "Y" ) {
            //         $query->where("e_cont", "like", "%" . $request->q . "%");
            //     }

            //     $query->where("o_state", $request->state);
            //  }         

            if ($request->pay_state) {
                $query->where("o_pay_state", $request->pay_state);
            }
        })
        ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_product_orders.o_member')
        ->orderBy("o_no","desc")->paginate(20);

        $data['productType'] = Config::get('product.productType');


        $data['start'] = $data["orders"]->total() - $data["orders"]->perPage() * ($data["orders"]->currentPage() - 1);
        $data['total'] = $data["orders"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        return view('partner.history_orders',$data);
    }

    
    ## 사용목록
    public function reserv_list(Request $request){

        $data["FrenchReserves"] = [];
        $data['productType'] = [];
        
        $data["ageType"] = config("product.memberAgeType");
        $data["sexType"] = config("product.memberSexType");
        $data["fromType"] = config("product.memberFromType");
        $data["productType"] = config("product.productType");
                
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["reservs"] = [];
        $data["reservs"] = $this->FrenchReservSeat->select(['french_reserv_seats.*','french_members.mb_name','french_members.mb_phone','french_rooms.r_name','french_seats.s_name'])
        ->where(function ($query) use ($request) {
            if ($request->q) {
                $query->where("o_member_name", "like", "%" . $request->q . "%");
                    //->orwhere("o_title", "like", "%" . $request->q . "%")
            }

            if ($request->pkind) {
                $query->where( "french_reserv_seats.rv_product_kind", $request->pkind);
            }

            if ($request->state) {
                $query->where( "french_reserv_seats.rv_state", $request->state);
            }

            if ($request->sdate) {
                $query->where( DB::raw("date_format(french_reserv_seats.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }

            if ($request->edate) {
                $query->where( DB::raw("date_format(french_reserv_seats.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

            if ($request->q) {
                $query->where("french_product_orders.o_member_name",  "Like", "%".$request->q."%");
            }   

            if ($request->pay_state) {
                $query->where("o_pay_state", $request->pay_state);
            }
        })
        ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_reserv_seats.rv_member')
        ->leftjoin('french_rooms', 'french_rooms.r_no', '=', 'french_reserv_seats.rv_room')
        ->leftjoin('french_seats', 'french_seats.s_no', '=', 'french_reserv_seats.rv_seat')
        ->orderBy("rv_no","desc")->paginate(20);

        $data['productType'] = Config::get('product.productType');

        $data['start'] = $data["reservs"]->total() - $data["reservs"]->perPage() * ($data["reservs"]->currentPage() - 1);
        $data['total'] = $data["reservs"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        $now = \Carbon\Carbon::now()->toDateTimeString();

        for( $i = 0; $i<=count($data["reservs"])-1; $i++ ) {

            // if( $data["reservs"][$i]["rv_sdate"] > $now ) {
            //     $data["reservs"][$i]["rv_state"] = "예약";
            // } elseif( $data["reservs"][$i]["rv_sdate"] >= $now &&  $data["reservs"][$i]["rv_edate"] <= $now  ) {
            //     $data["reservs"][$i]["rv_state"] = "사용중";                
            // } elseif( $data["reservs"][$i]["rv_edate"] <= $now ) {
            //     $data["reservs"][$i]["rv_state"] = "종료";                
            // } 

            if( $data["reservs"][$i]["rv_state"] == "A" ) {
                $data["reservs"][$i]["rv_state_text"] = "예약";
            } elseif( $data["reservs"][$i]["rv_state"] == "U"  ) {
                $data["reservs"][$i]["rv_state_text"] = "사용중";                
            } elseif( $data["reservs"][$i]["rv_state"] == "X" ) {
                $data["reservs"][$i]["rv_state_text"] = "종료";                
            } 

        }
            
            
        return view('partner.history_reservs',$data);
    }

}
