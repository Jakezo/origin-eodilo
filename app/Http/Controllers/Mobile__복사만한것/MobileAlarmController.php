<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class MobileAlarmController extends Controller
{

    public function __construct()
    {
        $this->message = new UserMessage();
    }


    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        if(isset(Auth::guard('user')->user()->id)){
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
        return view('mobile.alarm', $data);
        }else{
            return redirect('alarm_login');
        }
    }
}
