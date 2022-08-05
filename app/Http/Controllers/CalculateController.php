<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\MobileProductOrder;
use App\Models\MobileReservSeat;
use App\Models\PartnerCalculate;

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
    public function update(Request $request)
    {
        
        $culculate = \App\Models\PartnerCalculate::find($request->no);

        if( $culculate ) {
            $culculate->cal_status = $request->st;
            $data["result"] = $culculate->update();

        } else {
            $data["result"] = false;
        }
        return response($data);
    }

    public function getInfo(Request $request)
    {
        $data["culculates"] = \App\Models\PartnerCalculate::select("cal_no","cal_status","cal_revenue","cal_commission","cal_reserve_count")->where("cal_no",$request->no)->first();
        $data["no"] = $request->no;
        if( $data["culculates"] ) {
            $data["result"] = true;
        } else {
            $data["result"] = false;
        }
        return response($data);
    }

    public function day(Request $request)
    {

        $data["culculates"] = [];
        $data["culculates"] = \App\Models\PartnerCalculate::
        leftjoin("partners","partners.p_no","partner_calculates.cal_partner")
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

        return view('admin.calculate.day',$data);

    }

    public function month(Request $request)
    {
        if( !$request->y ) $request->y = date('Y');
        if( !$request->m ) $request->m = date('m');

        $data["culculates"] = [];
        $data["culculates"] = \App\Models\PartnerCalculate::select(
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

        return view('admin.calculate.month',$data);

    }
   
}
