<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User_cash;
use App\Models\UserCashBuy;
use App\Models\UserCashRefund;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class UserCashController extends Controller
{
    public function __construct()
    {
        $this->cashes = new User_cash();
    }

    public function refund(Request $request){

        $data = [];

        $data["refunds"] = \App\Models\UserCashRefund::select("user_cash_refunds.*",DB::raw("users.id,users.name,users.nickname,users.email"))
        ->where(function ($query) use ($request) {
            if ($request->q) {
                $query->where("users.name", "like", "%" . $request->q . "%")
                    ->orwhere("users.nickname", "like", "%" . $request->q . "%")
                    ->orwhere("users.email", "like", "%" . $request->q . "%");
            }
            if ($request->sdate) {
                $query->where( DB::raw("date_format(user_cash_refunds.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
            }
            if ($request->edate) {
                $query->where( DB::raw("date_format(user_cash_refunds.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
            }

            if ($request->refund) {
                    $query->where("cr_refund", $request->refund);
            }   
        })
        ->leftjoin('users', 'users.id', '=', 'user_cash_refunds.cr_member')
        ->orderBy("created_at")
        ->paginate(10);

        $data['start'] = $data["refunds"]->total() - $data["refunds"]->perPage() * ($data["refunds"]->currentPage() - 1);
        $data['total'] = $data["refunds"]->total();
        $data['param'] = [
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'refund' => $request->refund,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        return view('admin.member.refund_list',$data);

    }

    ## 폼을 위한 정보
    public function refund_getInfo(Request $request){
        $data["result"] = true;
        $data["refund"] = \App\Models\UserCashRefund::find($request->no);
        $data["refund"]["cr_refund_at"] = substr($data["refund"]->cr_refund_at,0,10);
        return response($data);
    }

    public function refund_update(Request $request){

        $data = [];

        $data["refund"] = \App\Models\UserCashRefund::find($request->no);

        $data["refund"]->cr_memo = $request->memo;
        $data["refund"]->cr_money = $request->money;

        if( $data["refund"]["cr_refund"] != "Y" && $request->refund =="Y") {
            $data["refund"]->cr_refund = $request->refund;
            $data["refund"]->cr_refund_at = $request->refund_at;
        }

        $data["refund"]->update();

        return response($data);

    }

}
