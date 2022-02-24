<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrenchNoticeController extends Controller
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
        $data["b_id"] = $request->b_id;
        $data["boards"] = $this->board->select()
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
                if( $request->b_id ) {
                    $query->where("b_id", $request->b_id);
                }
                if( $request->state ) {
                    $query->where("b_state", $request->state);
                }
            })
            ->orderBy("b_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["boards"]->total() - $data["boards"]->perPage() * ($data["boards"]->currentPage() - 1);
        $data['total'] = $data["boards"]->total();
        $data["boards"]->perPage();
        $data['param'] = ['fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());
        return view('partner.community.list' , $data);
    }

    ## 상세를 위한 정보
    public function view(Request $request){

        $data["result"] = true;
        $data["b_id"] = $request->b_id;
        if( $request->no ) {
            $data["board"] = $this->board->select()
                ->where("b_no",  $request->no)
                ->where("b_id",  $request->b_id)
                ->first();

            if( !$data["board"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

        } else {
            $data["board"] = [];
        }
        return view('partner.community.view', $data);
    }

}
