<?php

namespace App\Http\Controllers\Partner;
use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\UserCashBuy;
use Carbon\Carbon;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class FrenchCalculateController extends Controller
{
    public function __construct()
    {
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();     
    }

    public function day(Request $request)
    {
        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["sales"] = [];
        $data["sales"] = $this->FrenchReservSeat->select(DB::raw("count(rv_no) as count_rv, sum(TIMESTAMPDIFF(MINUTE, rv_sdate, rv_edate)) as sum_time , date_format(rv_sdate,'%Y-%m-%d') as std_date"))
        ->where(function ($query) use ($request) {

            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }

            if ($request->sdate) {
                $query->where( DB::raw("date_format(french_reserv_seats.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }

            if ($request->edate) {
                $query->where( DB::raw("date_format(french_reserv_seats.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
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

        return view('partner.calculate.day',$data);

    }

    public function month(Request $request)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account);        

        if( !$request->y ) $request->y = date('Y');
        if( !$request->m ) $request->m = date('m');

        //DB::enableQueryLog();	//query log 시작 선언부
        $data["sales"] = [];
        $data["sales"] = $this->FrenchReservSeat->select(DB::raw("count(rv_no) as count_rv, sum(TIMESTAMPDIFF(MINUTE, rv_sdate, rv_edate)) as sum_time , date_format(rv_sdate,'%Y-%m') as std_date"))
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

        return view('partner.calculate.month',$data);

    }
   
}
