<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customdev;
use App\Models\BoardsComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CustomdevController extends Controller
{
    public function __construct()
    {
        $this->custom = new Customdev();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["customs"] = [];
        $data["customs"] = $this->custom->select()
            ->select("customdevs.*", "partners.p_name")
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

        return view('admin.customer.qna_dev', $data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $custom = \App\Models\Customdev::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Customdev();
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

    public function delete(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $custom = \App\Models\Customdev::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Customdev();
        }

        if( $custom->q_no ) {
            $result['result'] = $custom->delete();
        } else {

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
            $custom = \App\Models\Customdev::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Customdev();
        }

        //$custom->a_admin = $request->a_admin ?? 0;
        $custom->a_title = $request->title ?? "";
        $custom->a_cont = $request->cont ?? "";
        if( $custom->a_answer=="N" && $request->answer =="Y" ) {
            $custom->a_answer_at = \Carbon\Carbon::now()->toDateTimeString();
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
    public function answerform(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["custom"] = $this->custom->select()->where("q_no",  $request->no)->first();

            if( !$data["custom"] ) {
                return redirect()->back()->withErrors(['alert', 'Updated!']);
            }

        } else {
            $data["custom"] = [];
        }
        return view('admin.customer.qna_dev_answerform', $data);
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
        return view('admin.customer.qna_dev_view', $data);
    }


    public function comm_update(Request $request)
    {

        $result = [];

        if( $request->no ) {
            $custom = \App\Models\Customdev::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Customdev();
        }

        if( $custom->q_no ) {

            if( $request->c_no ) {
                $BoardsComment = \App\Models\BoardsComment::where('q_no', $request->no)->firstOrFail();
            } else {
                $BoardsComment = new BoardsComment();
            }

            $BoardsComment->c_board = $request->board ?? "";
            $BoardsComment->c_parent = $request->no ?? "";
            $BoardsComment->c_comments = $request->comm ?? "";
            $BoardsComment->c_emp = Auth::guard("admin")->user()->admin_no ?? "";
            $BoardsComment->c_uname = Auth::guard("admin")->user()->admin_name ?? "";

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
            $custom = \App\Models\Customdev::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Customdev();
        }

        if( $custom->q_no ) {

            $BoardsComment = \App\Models\BoardsComment::where('c_parent', $request->no)->where('c_no', $request->comm_no)->firstOrFail();

            if( $BoardsComment ) {

                if( $BoardsComment->c_emp == Auth::guard("admin")->user()->admin_no ) {
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
            $custom = \App\Models\Customdev::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new Customdev();
        }

        if( $custom->q_no ) {
            $data['result'] = true;
            $data["comments"] = [];
            $data["comments"] = \App\Models\BoardsComment::select("c_no","c_parent","c_emp","c_uname","c_comments","created_at as rdate")->where('c_parent', $request->no)->get();
            //where("c_board", $request->board);
            //->where('c_parent', $request->no);

            foreach(  $data["comments"] as $comments ) {
                $comments->c_comments = nl2br($comments->c_comments);
                if( $comments->c_emp == Auth::guard("admin")->user()->admin_no ) {
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
