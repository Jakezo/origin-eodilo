<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Helpboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HelpboardController extends Controller
{
    public $helpboard;

    public function __construct()
    {
        $this->helpboard = new Helpboard();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["helpboards"] = [];
        $data["helpboards"] = $this->helpboard->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("b_uname", "like", "%" . $request->q . "%");
                    } elseif( $request->fd == "title" ) {
                        $query->where("b_title", "like", "%" . $request->q . "%");
                    }  elseif( $request->fd == "cont" ) {
                        $query->where("b_cont", "like", "%" . $request->q . "%");
                    } else {
                        $query->where("b_uname", "like", "%" . $request->q . "%")
                            ->orwhere("b_title", "like", "%" . $request->q . "%")
                            ->orwhere("b_cont", "like", "%" . $request->q . "%");
                    }
                }
                if( $request->state ) {
                    $query->where("b_state", $request->state);
                }
            })
            ->orderBy("b_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["helpboards"]->total() - $data["helpboards"]->perPage() * ($data["helpboards"]->currentPage() - 1);
        $data['total'] = $data["helpboards"]->total();
        $data["helpboards"]->perPage();
        $data['param'] = ['fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.manual.manual_board' , $data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $helpboard = \App\Models\Helpboard::where('b_no', $request->no)->firstOrFail();
        } else {
            $helpboard = new Helpboard();
        }

        $helpboard->b_partner = $request->partner ?? 0;
        $helpboard->b_member = $request->member ?? "";
        $helpboard->b_uname = $request->uname ?? "";
        $helpboard->b_title = $request->title ?? "";
        $helpboard->b_cont = $request->cont ?? "";
        $helpboard->b_state = $request->state ?? "N";

        $result["helpboard"] = $helpboard;
        if( $helpboard->b_no ) {
            $result['result'] = $helpboard->update();
        } else {
            $result['result'] = $helpboard->save();
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    ## 폼을 위한 정보
    public function form(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["board"] = $this->helpboard->select()
                ->where("b_no",  $request->no)
                ->first();

            if( !$data["board"] ) {
                return redirect()->back()->withErrors(['alert', '존재하지 않는 정보입니다.']);
            }

        } else {
            $data["board"] = [];
        }
        return view('admin.manual.manual_board_form', $data);
    }
}
