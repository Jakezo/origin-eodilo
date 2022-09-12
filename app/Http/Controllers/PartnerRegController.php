<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerReg;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PartnerRegController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $partner;

    public function __construct()
    {
        $this->partnerReg = new PartnerReg();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["partner_regs"] = [];
        $data["partner_regs"] = $this->partnerReg->select()
            ->select("partner_regs.*", "partners.p_name")
            ->leftjoin('partners', 'pr_partner', '=', 'partners.p_no')
            ->orderBy("pr_no","desc")->paginate(10)->setPath('')->appends(request()->query());

        $data['total'] = $data["partner_regs"]->total();
        $data['start'] = $data["partner_regs"]->total() - $data["partner_regs"]->perPage() * ($data["partner_regs"]->currentPage() - 1);
        $data['param'] = ['state' => $request->sdate, 'edate' => $request->edate, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());
        return view('admin.partner.reg', $data);
    }


    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //return (DB::getQueryLog());
        $result = [];
        if( $request->no ) {
            $partnerReg = \App\Models\PartnerReg::where('pr_no', $request->no)->firstOrFail();
        } else {
            $partnerReg = new PartnerReg();
        }

        $partnerReg->pr_partner = $request->partner ?? 0;
        $partnerReg->pr_sdate = $request->sdate ?? "N";
        $partnerReg->pr_edate = $request->edate ?? "N";

        $partnerReg->pr_admin = $request->admin ?? 0;
        $partnerReg->pr_pay_kind = $request->pay_kind ?? "";
        if( $partnerReg->pr_pay_kind != "") {
            $partnerReg->pr_pay = "Y";
        } else {
            $partnerReg->pr_pay = "N";
        }
        $partnerReg->pr_pay_money = $request->pay_money ?? 0;
        $partnerReg->pr_memo = $request->memo ?? "";

        $result["partnerReg"] = $partnerReg;

        if( $partnerReg->p_no ) {
            $result['result'] = $partnerReg->update();
        } else {
            $result['result'] = $partnerReg->save();
        }
        if( $partnerReg->pr_edate != "0000-00-00") {
            $partner = \App\Models\Partner::find($partnerReg->pr_partner);
            $partner->p_last_dt = $partnerReg->pr_edate;
            $result["partner"] = $partner->update();
        }


        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }


    public function defaultReg($partner)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //return (DB::getQueryLog());
        $result = [];
        $partnerReg = new PartnerReg();
        $partnerReg->pr_partner = $partner;
        $partnerReg->pr_sdate = now()->format("Y-m-d H:i:s");
        $partnerReg->pr_edate = now()->addYear(1)->format("Y-m-d H:i:s");

        $partnerReg->pr_admin = 0;
        $partnerReg->pr_pay_kind = "R";
        $partnerReg->pr_pay = "Y";

        $partnerReg->pr_pay_money = 0;
        $partnerReg->pr_memo = "최초등록";

        $result["partnerReg"] = $partnerReg;
        $result['result'] = $partnerReg->save();

        if( $partnerReg->pr_edate != "0000-00-00") {
            $partner = \App\Models\Partner::where('p_no', $partnerReg->pr_partner)->firstOrFail();
            $partner->p_last_dt = $partnerReg->pr_edate;
            $result["partner"] = $partner->update();
        }
        return response($result);
    } 
    
    ## 폼을 위한 정보
    public function getInfo(Request $request){

        $data["reg"] = $this->partnerReg::select("partner_regs.*","partners.p_no","partners.p_name")
        ->where("pr_no",$request->no)
        ->leftJoin("partners","partners.p_no","partner_regs.pr_partner")
        ->first();

        if( $data["reg"] ) {
            $data["result"] = true;
        } else {
            $data["result"] = false;
        }
        return response($data);
    }

}
