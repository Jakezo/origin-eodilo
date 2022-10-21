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

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();  
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

        return view('admin.statistics.day',$data);

    }

    public function TodayCommission(Request $request)
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

        return view('admin.statistics.day',$data);
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

        return view('admin.statistics.month',$data);

    }

    public function cashbuy(Request $request)
    {

        $data["result"] = true;
        $data["cashbuys"] = \App\Models\UserCashBuy::where('cb_pay', "Y")
        ->where(function ($query) use ($request) {

            if ($request->q) {
                $query->where("users.id", "like", "%".$request->q."%")
                ->orwhere("users.name", "like", "%".$request->q."%")
                ->orwhere("users.nickname", "like", "%".$request->q."%")
                ->orwhere("users.phone", "like", "%".$request->q."%")
                ->orwhere("sb_friend_name", "like", "%".$request->q."%")
                ->orwhere("sb_friend_phone", "like", "%".$request->q."%");
            }
            if ($request->sdate) {
                $query->where( DB::raw("date_format(cb_pay_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }
            if ($request->edate) {
                $query->where( DB::raw("date_format(cb_pay_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

            if ($request->friend ) {
                    $query->where("cb_friend", $request->friend);
            }                    

            // if( $request->mode == "out" ) {
            //     $query->where("mp_point", "<" , 0);
            // }elseif( $request->mode == "in" ) {
            //         $query->where("mp_point", ">", 0);
            // }
        })
        ->leftjoin('users', 'users.id', '=', 'user_cash_buys.cb_member')
        ->orderBy("cb_no","desc")->paginate(10);

        $data['friend'] = $request->friend;
        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["cashbuys"]->total() - $data["cashbuys"]->perPage() * ($data["cashbuys"]->currentPage() - 1);
        $data['total'] = $data["cashbuys"]->total();
        $data['param'] = [
                'sdate' => $request->sdate, 
                'edate' => $request->edate, 
                'firend' => $request->firend, 
                'fd' => $request->fd, 
                'q' => $request->q];

        return view('admin.statistics.cashbuy',$data);

    }    
}
