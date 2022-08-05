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
        $this->partner = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

        $data["culculates"] = [];
        $data["culculates"] = \App\Models\PartnerCalculate::where("cal_partner", $this->partner->p_no)
        ->where(function ($query) use ($request) {

            if ($request->partner) {
                    $query->where("cal_partner", $request->partner );
            }

            if ($request->sdate) {
                $query->where( "cal_date",  ">=", $request->sdate);
            }

            if ($request->edate) {
                $query->where( "cal_date",  "<=", $request->edate);
            }

        })
        ->orderBy("cal_date","desc")
        ->orderBy("partner_calculates.cal_revenue","desc")        
        ->paginate(10);

        $data['start'] = $data["culculates"]->total() - $data["culculates"]->perPage() * ($data["culculates"]->currentPage() - 1);
        $data['total'] = $data["culculates"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'partner' => $request->partner,             
            'fd' => $request->fd, 
            'q' => $request->q];

        return view('partner.calculate.day',$data);

    }

    public function month(Request $request)
    {
        Config::set('database.connections.partner.database',"boss_".$request->account);
        $this->partner = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

        if( !$request->y ) $request->y = date('Y');
        if( !$request->m ) $request->m = date('m');

        $data["culculates"] = [];
        $data["culculates"] = \App\Models\PartnerCalculate::where("cal_partner", $this->partner->p_no)
        ->select(
            DB::raw("sum(partner_calculates.cal_revenue) as sum_revenue"),
            DB::raw("sum(partner_calculates.cal_commission) as sum_commission"),
            DB::raw("sum(partner_calculates.cal_reserve_count) as sum_reserve_count"),
            "partners.p_no", 
            "partners.p_name", 
            DB::raw("date_format(partner_calculates.cal_date,'%Y-%m') as month")
        )
        ->leftjoin("partners","partners.p_no","partner_calculates.cal_partner")
        ->where(function ($query) use ($request) {

            if ($request->partner) {
                    $query->where("cal_partner", $request->partner );
            }

            if ($request->sdate) {
                $query->where( "cal_date",  ">=", $request->sdate);
            }

            if ($request->edate) {
                $query->where( "cal_date",  "<=", $request->edate);
            }

        })
        ->groupBy("cal_partner","month")
        ->orderBy("month","desc")
        ->orderBy("partner_calculates.cal_revenue","desc")
        ->paginate(10);

        $data['start'] = $data["culculates"]->total() - $data["culculates"]->perPage() * ($data["culculates"]->currentPage() - 1);
        $data['total'] = $data["culculates"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'partner' => $request->partner,             
            'fd' => $request->fd, 
            'q' => $request->q];

        return view('partner.calculate.month',$data);

    }
   
}
