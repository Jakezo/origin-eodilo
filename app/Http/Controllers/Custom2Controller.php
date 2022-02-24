<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Custom2;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Custom2Controller extends Controller
{
    public function __construct()
    {
        $this->custom = new Custom2();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

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

        return view('admin.customer.qna_partner', $data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $custom = \App\Models\Custom2::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Custom2();
        }

        $custom->q_partner = $request->partner ?? 0;
        $custom->q_member = $request->member ?? 0;
        $custom->q_uname = $request->uname ?? "";
        $custom->q_title = $request->title ?? "";
        $custom->q_cont = $request->cont ?? "";
        $custom->q_file = $request->file ?? "";
        $custom->q_read = $request->read ?? "N";

        $custom->a_admin = $request->a_admin ?? 0;
        $custom->a_title = $request->a_title ?? "";
        $custom->a_cont = $request->a_cont ?? "";
        $custom->a_answer = $request->a_answer ?? "N";
        $custom->a_answer_at = $request->a_answer_at ?? "";

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


    public function answer(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $custom = \App\Models\Custom2::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Custom2();
        }

        //$custom->a_admin = $request->a_admin ?? 0;
        $custom->a_title = $request->title ?? "";
        $custom->a_cont = $request->cont ?? "";
        if( $custom->a_answer=="N" && $request->answer =="Y" ) {
            $custom->a_answer_at = \Carbon\Carbon::now()->toDateTimeString();;
        }
        $custom->a_answer = $request->answer ?? "N";
        $result['result'] = $custom->update();

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    ## 폼을 위한 정보
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
        return view('admin.customer.qna_partner_view', $data);
    }
}
