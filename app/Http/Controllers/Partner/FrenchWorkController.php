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

class FrenchWorkController extends Controller
{


    public function __construct()
    {
    }
 
    ## 종료
    public function day_end(Request $request)
    {        
        Config::set('database.connections.partner.database',"boss_".$request->account);        

        return view('partner.work.day_end');
    }

    ## 남은시간
    public function remaining_time(Request $request)
    {      
        Config::set('database.connections.partner.database',"boss_".$request->account);        

		$data["remaind_time"] = \App\Models\FrenchProductOrder::where("o_remainder",">",0)
		->where("o_product_kind","T")->sum("o_remainder_time");


		$data["remaind_day"] = \App\Models\FrenchProductOrder::where("o_remainder",">",0)
		->where("o_product_kind","D")->sum("o_remainder_day");

		$data["orders"] = \App\Models\FrenchProductOrder::where("o_remainder",">",0)
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
		})
		->orderBy("o_no","desc")->paginate(10);

        $productType = Config::get('product.productType');

        foreach( $data["orders"] as $order ) {

            $order->o_product_name = $productType[$order->o_product_kind];

            if ( $order->o_product_kind == "A") {
                $order->o_duration_tail = "";
            } elseif ( $order->o_product_kind == "D") {
                $order->o_duration_tail = "일";
            } elseif ( $order->o_product_kind == "F") {
                $order->o_duration_tail = "개월";
            } elseif ( $order->o_product_kind == "T") {
                $order->o_duration_tail = "시간";
            }

        }

        $data['start'] = $data["orders"]->total() - $data["orders"]->perPage() * ($data["orders"]->currentPage() - 1);
        $data['total'] = $data["orders"]->total();
        $data['param'] = [
                'state' => $request->state, 
                'sdate' => $request->sdate, 
                'edate' => $request->edate, 
                'fd' => $request->fd, 
                'q' => $request->q];


		return view('partner.work.remaining_time',$data);

    }

  
}
