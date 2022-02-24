<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Vodboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrenchVodboardController extends Controller
{
    public $vodboard;

    public function __construct()
    {
        $this->vodboard = new Vodboard();
    }



    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["vodboards"] = [];
        $data["vodboards"] = $this->vodboard->select()
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
            ->orderBy("b_no","desc")->paginate(20);

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["vodboards"]->total() - $data["vodboards"]->perPage() * ($data["vodboards"]->currentPage() - 1);
        $data['total'] = $data["vodboards"]->total();
        $data["vodboards"]->perPage();
        $data['param'] = ['fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        

        return view('partner.manual.manual_vod' , $data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $vodboard = \App\Models\Vodboard::where('b_no', $request->no)->firstOrFail();
        } else {
            $vodboard = new Vodboard();
        }

        $vodboard->b_partner = $request->partner ?? 0;
        $vodboard->b_member = $request->member ?? "";
        $vodboard->b_uname = $request->uname ?? "";
        $vodboard->b_title = $request->title ?? "";
        $vodboard->b_vod = $request->vod ?? "";
        $vodboard->b_cont = $request->cont ?? "";
        $vodboard->b_state = $request->state ?? "N";

        $result["vodboard"] = $vodboard;
        if( $vodboard->b_no ) {
            $result['result'] = $vodboard->update();
        } else {
            $result['result'] = $vodboard->save();
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    ## 폼을 위한 정보
    public function gethtml(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["board"] = $this->vodboard->select()
                ->where("b_no",  $request->no)
                ->first();

            $result['title'] = $data["board"]->b_title;
            $result['html'] = '
            <div style="position: relative; height:0; padding-bottom: 56.25%;" id="main_video">
                <iframe id="player" name="player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" style="position: absolute; width:100%; height:100%;" allowfullscreen="1" title="YouTube video player" width="640" height="360" src="' . $data["board"]->b_vod . '"></iframe>
            </div>';

            if( !$data["board"] ) {
                $result['result'] = true;
            } else {
                $result['result'] = false;
            }

            return response($result);

        } else {
            $data["board"] = [];
        }
        return view('admin.manual.manual_vod_form', $data);
    }

    ## 팝업을 위한 정보
    public function form(Request $request){

        $data["result"] = true;
        if( $request->no ) {
            $data["board"] = $this->vodboard->select()
                ->where("b_no",  $request->no)
                ->first();

            if( !$data["board"] ) {
                return redirect()->back()->withErrors(['alert', '존재하지 않는 정보입니다.']);
            }

        } else {
            $data["board"] = [];
        }
        return view('admin.manual.manual_vod_form', $data);
    }
}
