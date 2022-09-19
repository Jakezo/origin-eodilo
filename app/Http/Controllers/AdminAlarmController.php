<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminAlarm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminAlarmController extends Controller
{
    public function __construct()
    {

    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["alarms"] = [];
        $data["alarms"] = \App\Models\AdminAlarm::select("admin_alarms.*","users.id","users.name","users.nickname","users.email", DB::raw("TIMESTAMPDIFF('MINUTE',now(), admin_alarms.created_at) as diff_time"))
            ->leftjoin('users', 'admin_alarms.a_user', '=', 'users.id')
            ->where(function ($query) use ($request) {

                if( $request->fd ) {
                    $query->where("a_kind", $request->fd);
                }

                if ($request->q) {
                        $query->where("users.name", "like", "%" . $request->q . "%")
                            ->orwhere("users.nickname", "like", "%" . $request->q . "%")
                            ->orwhere("users.email", "like", "%" . $request->q . "%");
                }
                if ($request->sdate) {
                    $query->where( DB::raw("date_format(admin_alarms.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("date_format(admin_alarms.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
                }
            })
            ->orderBy("a_no","desc")->paginate(10);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["alarms"]->total() - $data["alarms"]->perPage() * ($data["alarms"]->currentPage() - 1);
        $data['total'] = $data["alarms"]->total();
        $data['param'] = [ 'fd' => $request->fd, 'q' => $request->q, 'sdate' => $request->sdate, 'edate' => $request->edate];
        //dd(DB::getQueryLog());
        return view('admin.log.admin_alarm_list', $data);
    }

    public function getNewNotifications(Request $request){

        $data["result"] = true;
        $data["alarms"] = \App\Models\AdminAlarm::select("admin_alarms.*",DB::raw("TIMESTAMPDIFF(MINUTE,now(), admin_alarms.created_at) as diff_time"))
            ->orderBy("a_no","desc")->take(15)->get();

        foreach( $data["alarms"] as $i => $alarms ) {
            $alarms->a_title = \Illuminate\Support\Str::limit($alarms->a_title,28,"..");

            if( $alarms->diff_time > 120 ) {
                $alarms->time_txt = floor($alarms->diff_time/60) . "시간전";
            } else if( $alarms->diff_time > 1 && $alarms->diff_time < 120 ) {
                $alarms->time_txt = $alarms->diff_time . "분전";
            } else {
                $alarms->time_txt = "방금전";
            }
        }            

        return response($data);

    }
}
