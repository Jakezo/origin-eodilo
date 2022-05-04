<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MobileBoardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $board;

    public function __construct()
    {
        $this->board = new Board();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["boards"] = [];
        $data["boards"] = $this->board->select()
            ->where("b_id", $board="notice")
            ->where(function ($query) use ($request) {
            })
            ->orderBy("b_no","desc")->paginate(10);

        $data['query'] = $request->query;
        $data['start'] = $data["boards"]->total() - $data["boards"]->perPage() * ($data["boards"]->currentPage() - 1);
        $data['total'] = $data["boards"]->total();
        $data["boards"]->perPage();
        $data['param'] = ['fd' => $request->fd, 'q' => $request->q];
       
        return view('mobile.more_notice_list', $data);
    }

    ## 폼을 위한 정보
    public function form(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["board"] = $this->board->select()
                ->where("b_no",  $request->no)
                ->first();

            if( !$data["board"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

        } else {
            $data["board"] = [];
        }
        return view('mobile.more_notice_view', $data);
    }
}