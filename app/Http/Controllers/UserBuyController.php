<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\MobileProductOrder;

class UserBuyController extends Controller
{
    public function __construct()
    {
        $this->MobileProductOrder = new MobileProductOrder();
    }

    ## 목록
    public function index(Request $request){


        //DB::enableQueryLog();	//query log 시작 선언부
        $data["orders"] = [];


        $data["orders"] = $this->MobileProductOrder->select(DB::raw("sum(o_price_total), sum(o_pay_cash), sum(o_price_total), sum(o_price_total), sum(o_price_total), ") )
        ->where(function ($query) use ($request) {
            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }
            if ($request->sdate) {
                $query->where( DB::raw("date_format(mobile_product_orders.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }
            if ($request->edate) {
                $query->where( DB::raw("date_format(mobile_product_orders.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

            if ($request->pkind) {
                    $query->where("o_product_kind", $request->pkind);
            }            
            if ($request->pay_state) {
                $query->where("o_pay_state", $request->pay_state);
            }
        })
        ->leftjoin('users', 'users.id', '=', 'mobile_product_orders.o_member')
        ->leftjoin('partners', 'partners.p_no', '=', 'mobile_product_orders.o_partner')
        ->orderBy("o_no","desc")->paginate(6);



        $data["orders"] = $this->MobileProductOrder->select("mobile_product_orders.*","users.id", "users.name","partners.p_no", "partners.p_name", "partners.p_id")
        ->where(function ($query) use ($request) {
            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }
            if ($request->sdate) {
                $query->where( DB::raw("date_format(mobile_product_orders.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }
            if ($request->edate) {
                $query->where( DB::raw("date_format(mobile_product_orders.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
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
        ->leftjoin('users', 'users.id', '=', 'mobile_product_orders.o_member')
        ->leftjoin('partners', 'partners.p_no', '=', 'mobile_product_orders.o_partner')
        ->orderBy("o_no","desc")->paginate(6);

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

			return view('admin.member.buy_list', $data);

    }


}
