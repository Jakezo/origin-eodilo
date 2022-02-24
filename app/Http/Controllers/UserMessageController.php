<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UserMessageController extends Controller
{
    public function __construct()
    {
        $this->message = new UserMessage();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["messages"] = [];
        $data["messages"] = $this->message->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "member" ) {
                        $query->where("msg_member", "like", "%" . $request->q . "%");
                    } elseif( $request->fd == "title" ) {
                        $query->where("msg_title", "like", "%" . $request->q . "%");
                    }  elseif( $request->fd == "cont" ) {
                        $query->where("msg_cont", "like", "%" . $request->q . "%");
                    } else {
                        $query->where("msg_member", "like", "%" . $request->q . "%")
                            ->orwhere("msg_title", "like", "%" . $request->q . "%")
                            ->orwhere("msg_cont", "like", "%" . $request->q . "%");
                    }
                }

            })
            ->orderBy("msg_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["messages"]->total() - $data["messages"]->perPage() * ($data["messages"]->currentPage() - 1);
        $data['total'] = $data["messages"]->total();
        $data['param'] = ['answer' => $request->answer, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());
        return view('admin.member.sms_list', $data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $message = \App\Models\UserMessage::where('msg_no', $request->no)->firstOrFail();
        } else {
            $message = new UserMessage();
        }

        $message->msg_icon = $request->icon ?? '';
        $message->msg_member = $request->member ?? 0;
        $message->msg_title = $request->title ?? "";
        $message->msg_cont = $request->cont ?? "";
        if( $request->kind ) $message->msg_sms = "Y"; else $message->msg_sms = "N";
        if( $request->kakao ) $message->msg_kakao = "Y"; else $message->msg_kakao = "N";
        if( $request->push ) $message->msg_push = "Y"; else $message->msg_push = "N";

        if( $message->msg_no ) {
            $result['result'] = $message->update();
        } else {
            $result['result'] = $message->save();
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

}
