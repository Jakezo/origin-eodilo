<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\MobileProductOrder;
use App\Models\MobileReservSeat;
use App\Models\UserCashBuy;
use Carbon\Carbon;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class CalculateController extends Controller
{
    public function __construct()
    {
        $this->MobileProductOrder = new MobileProductOrder();
        $this->MobileReservSeat = new MobileReservSeat();     
    }

    public function day(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["sales"] = [];
        $data["sales"] = $this->MobileReservSeat->select(DB::raw("count(rv_no) as count_rv, sum(TIMESTAMPDIFF(MINUTE, rv_sdate, rv_edate)) as sum_time , date_format(rv_sdate,'%Y-%m-%d') as std_date"),"partners.p_no","partners.p_name")
        ->leftjoin('partners', 'partners.p_no', '=', 'rv_partner')
        ->where(function ($query) use ($request) {

            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }

            if ($request->sdate) {
                $query->where( DB::raw("date_format(mobile_reserv_seats.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }

            if ($request->edate) {
                $query->where( DB::raw("date_format(mobile_reserv_seats.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

        })
        ->groupBy('rv_partner')
        ->groupBy('std_date')
        ->orderBy("rv_no","desc")->paginate(100);

        $data['start'] = $data["sales"]->total() - $data["sales"]->perPage() * ($data["sales"]->currentPage() - 1);
        $data['total'] = $data["sales"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        return view('admin.calculate.day',$data);

    }

    public function month(Request $request)
    {
        if( !$request->y ) $request->y = date('Y');
        if( !$request->m ) $request->m = date('m');

        //DB::enableQueryLog();	//query log 시작 선언부
        $data["sales"] = [];
        $data["sales"] = $this->MobileReservSeat->select(DB::raw("count(rv_no) as count_rv, sum(TIMESTAMPDIFF(MINUTE, rv_sdate, rv_edate)) as sum_time , date_format(rv_sdate,'%Y-%m') as std_date"),"partners.p_no","partners.p_name")
        ->leftjoin('partners', 'partners.p_no', '=', 'rv_partner')
        ->where(function ($query) use ($request) {

            if ( $request->q ) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }

            if ( $request->y && $request->y != "ALL" ) {
                $query->where( DB::raw("date_format(rv_sdate,'%Y')"),  ">=", $request->y);
            }

            if ( $request->m && $request->m != "ALL" ) {
                $query->where( DB::raw("date_format(rv_sdate,'%m')"),  "<=", $request->m);
            }

        })
        ->groupBy('rv_partner')
        ->groupBy('std_date')
        ->orderBy("rv_no","desc")->paginate(100);

        $data['start'] = $data["sales"]->total() - $data["sales"]->perPage() * ($data["sales"]->currentPage() - 1);
        $data['total'] = $data["sales"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        return view('admin.calculate.month',$data);

    }
   
}
