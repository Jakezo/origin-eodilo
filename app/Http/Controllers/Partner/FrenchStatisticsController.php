<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use Carbon\Carbon;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class FrenchStatisticsController extends Controller
{
    public function __construct()
    {
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();     
    }

    public function sales_day(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["statistic"] = [];
        $data["sales"] = $this->FrenchProductOrder
            ->select("french_product_orders.*")
            ->select([
                DB::raw('count(*) as count_orders'), 
                DB::raw('sum(o_pay_money) as sum_moneys'), 
                DB::raw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m-%d' ) as std_day") ]
            )
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
            if ($request->sdate) {
                $query->whereRaw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m-%d' ) > '".$request->sdate."'");
            }      
            if ($request->edate) {
                $query->whereRaw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m-%d' ) < '".$request->edate."'");
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
        ->groupBy('std_day')
        ->orderBy("o_no","desc")->paginate(6);

        $data['productType'] = Config::get('product.productType');

        $data['start'] = $data["sales"]->total() - $data["sales"]->perPage() * ($data["sales"]->currentPage() - 1);
        $data['total'] = $data["sales"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        //return response($data);
        return view('partner.statistics.day',$data);

    }

    public function sales_month(Request $request)
    {
        if( !$request->y ) $request->y = date("Y"); 
        if( !$request->m ) $request->m = date("m"); 

        $data["statistic"] = [];
        $data["sales"] = $this->FrenchProductOrder
            ->select("french_product_orders.*")
            ->select([
                DB::raw('count(*) as count_orders'), 
                DB::raw('sum(o_pay_money) as sum_moneys'), 
                DB::raw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m' ) as std_day") ]
            )
        ->where(function ($query) use ($request) {
            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }
            if ($request->y  && $request->m ) {
                $ym = $request->y."-".$request->m;
                $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m')"),  ">=", $ym);
            }

        })
        ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_product_orders.o_member')
        ->groupBy('std_day')
        ->orderBy("o_no","desc")->paginate(6);

        $data['productType'] = Config::get('product.productType');

        $data['start'] = $data["sales"]->total() - $data["sales"]->perPage() * ($data["sales"]->currentPage() - 1);
        $data['total'] = $data["sales"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        //return response($data);
        return view('partner.statistics.month',$data);

    }    
}
