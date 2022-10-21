<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Partner;

class FrenchEventController extends Controller
{
    public function __construct()
    {
        $this->partner = new Partner();
        $this->event = new Event();
    }

 ## 목록
 public function index(Request $request){
    //DB::enableQueryLog();	//query log 시작 선언부
    $data["part"] = [];
    $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

    $data["events"] = [];
    $data["events"] = $this->event->select()
  
    ->where("e_partner", $data["part"]["p_no"])
    ->where(function ($query) use ($request) {
        if ($request->q) {
            if( $request->fd == "uname" ) {
                $query->where("e_uname", "like", "%" . $request->q . "%");
            } elseif( $request->fd == "title" ) {
                $query->where("e_title", "like", "%" . $request->q . "%");
            }  elseif( $request->fd == "cont" ) {
                $query->where("e_cont", "like", "%" . $request->q . "%");
            } else {
                $query->where("e_uname", "like", "%" . $request->q . "%")
                    ->orwhere("e_title", "like", "%" . $request->q . "%")
                    ->orwhere("e_cont", "like", "%" . $request->q . "%");
            }
        }
        if ($request->state) {

            if( $request->state == "A" ) {
                $query->where("e_sdate",  ">", now());
            } elseif( $request->state == "I" ) {
                $query->where("e_sdate",  "<=", now());
                $query->where("e_edate",  ">=", now());
            }  elseif( $request->state == "E" ) {
                $query->where("e_edate",  "<", now());
            }

        }
    })
    ->orderBy("e_no","desc")->paginate(6);

    $data['start'] = $data["events"]->total() - $data["events"]->perPage() * ($data["events"]->currentPage() - 1);
    $data['total'] = $data["events"]->total();
    $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];
    return view('partner.event.event_list',$data);
}

#저장, 업데이트
public function update(Request $request){


    $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();
    $result = [];
    if( $request->no ) {
        $event = \App\Models\Event::where('e_no', $request->no)->firstOrFail();
    } else {
        $event = new event();
    }

    $event->e_partner = $data["part"]["p_no"] ?? 0;
    $event->e_admin = $request->admin ?? 0;
    $event->e_sdate = $request->sdate ?? "";
    $event->e_manager = $request->manager ?? 0;
    $event->e_edate = $request->edate ?? "";
    $event->e_type = $request->type ?? "";
    $event->e_value = $request->value ?? "";
    $event->e_title = $request->title ?? "";
    $event->e_cont = $request->cont ?? "";
    $event->e_cont2 = $request->cont2 ?? "";
    $event->e_read = $request->read ?? "N";

    if( $event->e_no ) {
        $result['result'] = $event->update();
    } else {
        $result['result'] = $event->save();
    }
    if( $request->rURL ) {
        $result['rURL'] = $request->rURL;
    } else {
        $result['rURL'] = "";
    }

    return response($result);
}
#폼정보
public function getInfo(Request $request){
    $data["result"] = true;
    $data["event"] = $this->event->select(
            [
                'e_no as no',
                'e_type as type',
                'e_sdate as sdate',
                'e_edate as edate',
                'e_title as title',
                'e_cont as cont',
                'e_cont2 as cont2',
                'e_partner as partner',
                'e_value as value'
            ]
        )
        ->where("e_no",  $request->no)->first();
    return response($data);
}
}


  