<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchBoard;
use App\Models\FrenchBoardsComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FrenchBoardController extends Controller
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
        $this->board = new FrenchBoard();
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
        return view('partner.work.work_board' , $data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $board = $this->board::where('b_no', $request->no)->firstOrFail();
            $request->rURL = "/work/work_board/view/" . $board->b_no;
        } else {
            $board = $this->board;
        }
        $board->b_id = $request->b_id ?? '';
        $board->b_partner = $request->partner ?? 0;
        $board->b_member = $request->member ?? "";
        $board->b_uname = $request->uname ?? "";
        $board->b_title = $request->title ?? "";
        $board->b_cont = $request->cont ?? "";


        $result["board"] = $board;
        if( $board->b_no ) {
            $result['result'] = $board->update();
        } else {
            $result['result'] = $board->save();
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
            $data["board"] = $this->board->select()
                ->where("b_no",  $request->no)
                ->first();

            if( !$data["board"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

        } else {
            $data["board"] = [];
        }
        return view('partner.work.work_board_form', $data);
    }

    ## 상세를 위한 정보
    public function view(Request $request){

        $data["result"] = true;
        $data["b_id"] = $request->b_id;

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
        return view('partner.work.work_board_view', $data);
    }


    public function comm_update(Request $request)
    {

        $result = [];

        if( $request->no ) {
            $board = $this->board::where('b_no', $request->no)->firstOrFail();
        } else {
            $board = new FrenchBoard();
        }

        if( $board->b_no ) {

            if( $request->c_no ) {
                $BoardsComment = \App\Models\FrenchBoardsComment::where('c_no', $request->no)->firstOrFail();
            } else {
                $BoardsComment = new FrenchBoardsComment();
            }            

            $BoardsComment->c_board = $request->board ?? "";
            $BoardsComment->c_parent = $request->no ?? "";
            $BoardsComment->c_comments = $request->comm ?? "";
            $BoardsComment->c_user = Auth::guard("partner")->user()->mn_no ?? "";
            $BoardsComment->c_uname = Auth::guard("partner")->user()->mn_name ?? "";

            if( $BoardsComment->c_no ) {
                $result['result'] = $BoardsComment->update();
            } else {
                $result['result'] = $BoardsComment->save();
            }
            $result['no'] = $BoardsComment->c_no;

        } else {
            $result['result'] = false;
            $result['message'] = "해당글이 존재하지 않습니다.";
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }



    public function comm_delete(Request $request)
    {

        $result = [];

        if( $request->no ) {
            $board = \App\Models\FrenchBoard::where('b_no', $request->no)->firstOrFail();
        } else {
            $board = new FrenchBoard();
        }
        if( $board->b_no ) {

            $BoardsComment = \App\Models\FrenchBoardsComment::where('c_parent', $request->no)->where('c_no', $request->comm_no)->firstOrFail();

            if( $BoardsComment ) {
                
                if( $BoardsComment->c_user == Auth::guard("partner")->user()->mn_no ) {
                    if( $BoardsComment->delete() ) {
                        $result['result'] = true;
                    } else {
                        $result['result'] = false;
                        $result['message'] = "삭제가 되지 않았습니다."; 
                    }
                } else {
                    $result['result'] = false;
                    $result['message'] = "권한이 없습니다."; 
                }

            } else {
                $result['result'] = false;
                $result['message'] = "존재하지 않는 댓글입니다.";
            }

        } else {
            $result['result'] = false;
            $result['message'] = "해당글이 존재하지 않습니다.";
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }    

    
    public function comm_list(Request $request)
    {

        $data = [];

        if( $request->no ) {
            $board = \App\Models\FrenchBoard::where('b_no', $request->no)->firstOrFail();
        } else {
            $board = new FrenchBoard();
        }

        if( $board->b_no ) {
            $data['result'] = true;
            $data["comments"] = [];
            $data["comments"] = \App\Models\FrenchBoardsComment::select("c_no","c_parent","c_user","c_uname","c_comments","created_at as rdate")->where('c_parent', $board->b_no)->get();
            //where("c_board", $request->board);
            //->where('c_parent', $request->no);

            foreach(  $data["comments"] as $comments ) {
                $comments->c_comments = nl2br($comments->c_comments);
                if( $comments->c_user == Auth::guard("partner")->user()->mn_no ) {
                    $comments->is_my = true;
                } else {
                    $comments->is_my = false;
                }
            }

        } else {
            $data['result'] = false;
            $data['message'] = "해당글이 존재하지 않습니다.";
        }

        return response($data);
    }    

}
