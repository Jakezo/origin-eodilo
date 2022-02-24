<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Custom2;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;



class FrenchCustomController extends Controller
{
    public function __construct()
    {
        $this->custom = new Custom2();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["part"] = [];
        $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

        $data["customs"] = [];
        $data["customs"] = $this->custom->select()
            ->select("custom2s.*", "partners.p_name")
            ->leftjoin('partners', 'q_partner', '=', 'partners.p_no')
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "uname" ) {
                        $query->where("q_uname", "like", "%" . $request->q . "%");
                    } elseif( $request->fd == "title" ) {
                        $query->where("q_title", "like", "%" . $request->q . "%");
                    }  elseif( $request->fd == "cont" ) {
                        $query->where("q_cont", "like", "%" . $request->q . "%");
                    } else {
                        $query->where("q_uname", "like", "%" . $request->q . "%")
                            ->orwhere("q_title", "like", "%" . $request->q . "%")
                            ->orwhere("q_cont", "like", "%" . $request->q . "%");
                    }
                }
                if( $request->answer ) {
                    $query->where("a_answer", $request->answer);
                }
            })
            ->orderBy("q_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["customs"]->total() - $data["customs"]->perPage() * ($data["customs"]->currentPage() - 1);
        $data['total'] = $data["customs"]->total();
        $data["customs"]->perPage();
        $data['param'] = ['answer' => $request->answer, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('partner.customer.qna_list', $data);
    }


    public function update(Request $request)
    {
        $result = [];
        if( $request->no ) {
            $custom = \App\Models\Custom2::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Custom2();
        }
        $custom->q_partner = $request->account_no ?? 0;
        $custom->q_uname = $request->uname ?? "";
        $custom->q_title = $request->title ?? "";
        $custom->q_cont = $request->cont ?? "";

        if( $custom->q_no ) {
            $result['result'] = $custom->update();
        } else {
            $result['result'] = $custom->save();
        }        

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    public function view(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["custom"] = $this->custom->select()->where("q_no",  $request->no)->first();

            if( !$data["custom"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

        } else {
            $data["custom"] = [];
        }
        return view('partner.customer.qna_view', $data);
    }

    public function edit(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["custom"] = $this->custom->select()->where("q_no",  $request->no)->first();
            $data["uname"] = $request->account_name ?? "";

            if( !$data["custom"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

        } else {
            $data["custom"] = [];
        }
        return view('partner.customer.qna_edit', $data);
    }



}
