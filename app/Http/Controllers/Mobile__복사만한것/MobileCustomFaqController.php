<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\CustomFaq;
use App\Models\Custom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MobileCustomFaqController extends Controller
{
    public function __construct()
    {
        $this->custom = new CustomFaq();
    }

    ## 목록
    public function index(Request $request){
        // DB::enableQueryLog();	//query log 시작 선언부

        $data["faq_categorys"] = Config::get('custom.faq_categorys');

        $data["faqs"] = [];
        $data["faqs"] = $this->custom->select()
            ->where(function ($query) use ($request) {
                if ($request->kind ) {                
                    if( $request->kind == "T" ) {
                        $query->where("q_top", ">" , 0);
                        
                    } else {
                        $query->where("q_kind", $request->kind);
                    }
                    
                }
                if( $request->q) {
                    $query->where( "q_title", "like", "%" . $request->q . "%");
                }
            })
            ->orderBy("q_seq","asc","q_top","asc","q_read","asc")
            ->paginate(10);
            // dd(DB::getQueryLog());


        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["faqs"]->total() - $data["faqs"]->perPage() * ($data["faqs"]->currentPage() - 1);
        $data['total'] = $data["faqs"]->total();
        $data["faqs"]->perPage();
        $data['param'] = ['kind' => $request->kind, 'fd' => $request->fd, 'q' => $request->q];
        

     
        return view('mobile.more_help_home', $data);
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
        return view('mobile.more_help_view', $data);
    }


     ## 1:1문의 폼
     public function form(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부


        if(isset(Auth::guard('user')->user()->id)){

        $data["faq_categorys"] = Config::get('custom.faq_categorys');

        $data["faqs"] = [];
        $data["faqs"] = $this->custom->select()
            ->where(function ($query) use ($request) {
                if ($request->kind ) {                
                    if( $request->kind == "T" ) {
                        $query->where("q_top", ">" , 0);
                        
                    } else {
                        $query->where("q_kind", $request->kind);
                    }
                    
                }
                if( $request->q) {
                    $query->where( "q_title", "%" . $request->q . "%");
                }
            })
            ->orderBy("q_seq","asc","q_top","asc","q_read","asc")
            ->paginate(10);


        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["faqs"]->total() - $data["faqs"]->perPage() * ($data["faqs"]->currentPage() - 1);
        $data['total'] = $data["faqs"]->total();
        $data["faqs"]->perPage();
        $data['param'] = [ 'q' => $request->q];
        //dd(DB::getQueryLog());

     
        return view('mobile.more_help_myform', $data);
       
        }else{
            return redirect('signin');
        }
    }
}