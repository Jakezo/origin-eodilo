<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomFaq;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CustomFaqController extends Controller
{
    public function __construct()
    {
        $this->custom = new CustomFaq();
    }

    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["faq_categorys"] = Config::get('custom.faq_categorys');

        $data["customs"] = [];
        $data["customs"] = $this->custom->select()
            ->where(function ($query) use ($request) {
                if ($request->kind ) {                
                    if( $request->kind == "T" ) {
                        $query->where("q_top", ">" , 0);
                        
                    } else {
                        $query->where("q_kind", $request->kind);
                    }
                    
                }
                if ($request->q) {

                    if( $request->fd == "title" ) {
                        $query->where("q_title", "like", "%" . $request->q . "%");
                    }  elseif( $request->fd == "cont" ) {
                        $query->where("q_cont", "like", "%" . $request->q . "%");
                    } else {
                        $query->where("q_title", "like", "%" . $request->q . "%")
                            ->orwhere("q_cont", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("q_seq","desc","q_top","asc")
            ->paginate(10);

            foreach( $data["customs"] as $k => $cu ) {
                if( $cu->q_kind )  $cu->q_kind_name = $data["faq_categorys"][$cu->q_kind];
                else $cu->q_kind_name = "";
            }

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["customs"]->total() - $data["customs"]->perPage() * ($data["customs"]->currentPage() - 1);
        $data['total'] = $data["customs"]->total();
        $data["customs"]->perPage();
        $data['param'] = ['answer' => $request->answer, 'fd' => $request->fd, 'q' => $request->q];
        //dd(DB::getQueryLog());

        return view('admin.community.faq_list', $data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $custom = \App\Models\CustomFaq::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new CustomFaq();
        }

        $custom->q_title = $request->title ?? "";
        $custom->q_cont = $request->cont ?? "";
        $custom->q_kind = $request->kind ?? "";
        $custom->q_seq = $request->seq ?? 0;
        $custom->q_top = $request->top ?? 0;

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

    ## 폼을 위한 정보
    public function getInfo(Request $request){
        $data["result"] = true;
        $data["custom"] = $this->custom->select(
                [
                    'q_no as no',
                    'q_title as title',
                    'q_cont as cont',
                    'q_kind as kind',
                    'q_top as top',
                    'q_seq as seq',
                ]
            )
            ->where("q_no",  $request->no)->first();
        return response($data);
    }

    public function delete(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $custom = \App\Models\CustomFaq::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new CustomFaq();
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

    public function read(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->no ) {
            $custom = \App\Models\CustomFaq::where('q_no', $request->no)->firstOrFail();
        } else {
            $custom = new CustomFaq();
        }

        //$custom->a_admin = $request->a_admin ?? 0;
        $custom->q_read++;
        
        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
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
        return view('admin.community.faq_view', $data);
    }




}
