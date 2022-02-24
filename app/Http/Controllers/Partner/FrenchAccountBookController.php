<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchAccountBook;
use App\Models\FrenchAccountDiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FrenchAccountBookController extends Controller
{

    public function __construct()
    {
        $this->FrenchAccountBook = new FrenchAccountBook;
        $this->FrenchAccountDiv = new FrenchAccountDiv;
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["AccountBooks"] = [];

        # 입금총액
        $data["total_in"] = $this->FrenchAccountBook->select(DB::Raw("count(*) as count , sum(ab_amount) as sum"))
            ->where("ab_kind","I")
            ->where(function ($query) use ($request) {
                if( $request->fd == "user" ) {
                    $query->where("ab_user", "like", "%" . $request->user . "%");
                } 
                if ($request->q) {
                        $query->where("ab_cont", "like", "%" . $request->q . "%");
                }
                if ($request->sdate) {
                    $query->where( DB::raw("ab_date"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("ab_date"),  "<=", $request->edate);
                }                   
            })->first();

        # 출금총액            
        $data["total_out"] = $this->FrenchAccountBook->select(DB::Raw("count(*) as count, sum(ab_amount) as sum"))
            ->where("ab_kind","O")
            ->where(function ($query) use ($request) {
                if( $request->fd == "user" ) {
                    $query->where("ab_user", "like", "%" . $request->user . "%");
                } 
                if ($request->q) {
                        $query->where("ab_cont", "like", "%" . $request->q . "%");
                }

                if ($request->sdate) {
                    $query->where( DB::raw("ab_date"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("ab_date"),  "<=", $request->edate);
                }                   
            })->first();

        # 차액        
        $data["total_sum"] = $data["total_in"]["sum"] - $data["total_out"]["sum"];

        $data["AccountBooks"] = $this->FrenchAccountBook->select()
            ->where(function ($query) use ($request) {

                if( $request->kind ) {
                    $query->where("ab_kind", $request->kind);
                } 

                if( $request->fd == "user" ) {
                    $query->where("ab_user", "like", "%" . $request->user . "%");
                } 

                if ($request->q) {
                        $query->where("ab_cont", "like", "%" . $request->q . "%");
                }

                if ($request->sdate) {
                    $query->where( DB::raw("ab_date"),  ">=", $request->sdate);
                }

                if ($request->edate) {
                    $query->where( DB::raw("ab_date"),  "<=", $request->edate);
                }                

            })
            ->orderBy("ab_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["AccountBooks"]->total() - $data["AccountBooks"]->perPage() * ($data["AccountBooks"]->currentPage() - 1);
        $data['total'] = $data["AccountBooks"]->total();
        $data["AccountBooks"]->perPage();
        $data['param'] = ['fd' => $request->fd, 'q' => $request->q, 'kind' => $request->kind, 'sdate' => $request->sdate, 'edate' => $request->edate];
        //dd(DB::getQueryLog());


        return view('partner.cash.list' , $data);
    }

    ## 폼을 위한 정보
    public function getInfo(Request $request){
        $data["result"] = true;
        $data["AccountBook"] = $this->FrenchAccountBook
            ->where("ab_no",  $request->no)->first();
        return response($data);
    }

    public function update(Request $request)
    {

        $result = [];

        if( $request->no ) {
            $FrenchAccountBook = $this->FrenchAccountBook::where('ab_no', $request->no)->firstOrFail();
        } else {
            $FrenchAccountBook = $this->FrenchAccountBook;
        }            

        if( !$request->kind ) {
            $result['result'] = false;
            $result['message'] = "입출금 구분을 선택해주세요.";    
            return response($result);         
        }           

        if( !$request->div ) {
            $result['result'] = false;
            $result['message'] = "항목을 선택해 주세요.";    
            return response($result);         
        }          

        if( !$request->cont ) {
            $result['result'] = false;
            $result['message'] = "내용을 입력해 주세요.";    
            return response($result);         
        }       

        if( !$request->amount ) {
            $result['result'] = false;
            $result['message'] = "금액을 입력해 주세요.";    
            return response($result);         
        }
     
        $FrenchAccountBook->ab_cont = $request->cont ?? "";
        $FrenchAccountBook->ab_date = $request->date ?? "";
        $FrenchAccountBook->ab_kind = $request->kind ?? "";
        $FrenchAccountBook->ab_div = $request->div ?? "";
        $FrenchAccountBook->ab_amount = $request->amount ?? "";
        if( $FrenchAccountBook->ab_no ) {
            $result['result'] = $FrenchAccountBook->update();
        } else {
            $FrenchAccountBook->ab_user = Auth::guard("partner")->user()->mn_no ?? "";            
            $result['result'] = $FrenchAccountBook->save();
        }
        $result['no'] = $FrenchAccountBook->ab_no;

        return response($result);
    }
 

    public function div_update(Request $request)
    {

        $result = [];

        if( $request->d_no ) {
            $FrenchAccountDiv = $this->FrenchAccountDiv::where('d_no', $request->no)->firstOrFail();
        } else {
            $FrenchAccountDiv = $this->FrenchAccountDiv;
        }            

        if( $request->name ) {
            $FrenchAccountDiv->d_name = $request->name ?? "";
            if( $FrenchAccountDiv->d_no ) {
                $result['result'] = $FrenchAccountDiv->update();
            } else {
                $result['result'] = $FrenchAccountDiv->save();
            }

            $result['no'] = $FrenchAccountDiv->d_no;
        } else {
            $result['result'] = false;
            $result['message'] = "항목명을 입력해 주세요."; 
        }

        return response($result);
    }

    public function div_delete(Request $request)
    {

        $result = [];

        if( $request->no ) {
            $FrenchAccountDiv = $this->FrenchAccountDiv::where('d_no', $request->no)->firstOrFail();

            if( $FrenchAccountDiv ) {
                
                $result['result'] = $FrenchAccountDiv->delete();

                if( !$result['result'] ) {
                    $result['message'] = "삭제가 되지 않았습니다."; 
                }

            } else {
                $result['result'] = false;
                $result['message'] = "존재하지 않는 항목입니다.";
            }

        } else {
            $result['result'] = false;
            $result['message'] = "항목이 선택되지 않았습니다.";
        }

        return response($result);
    }    

    
    public function div_list(Request $request)
    {

        $data = [];

        $data['result'] = true;
        //$data["divs"] = [];
        $data["divs"] = $this->FrenchAccountDiv::get();

        return response($data);
    } 


}
