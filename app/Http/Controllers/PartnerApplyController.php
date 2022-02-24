<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PartnerApply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class PartnerApplyController extends Controller
{
        /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $partner_apply;

    public function __construct()
    {
        $this->partner_apply = new PartnerApply();
    }

    ##목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부
        //$data["q"] = $request->q ?? "";
        $data["partner_apply"] = [];
        $data["partner_apply"] = $this->partner_apply->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    $query->where("app_state", "like", "%".$request->q."%")
                        ->orwhere("app_name", "like", "%".$request->q."%")
                        ->orwhere("app_address", "like", "%".$request->q."%")
                        ->orwhere("app_phone", "like", "%".$request->q."%")
                        ->orwhere("app_title", "like", "%".$request->q."%");
                } 
            })
            ->orderBy("app_no","desc")->paginate(10)->setPath('')->appends(request()->query());
            $data['param'] = ['fd' => $request->fd, 'q' => $request->q];
            
        //dd(DB::getQueryLog());
        return view('admin.partner.apply', $data);
    }


        ## 저장
        public function store(Request $request)
        { 
            
    /*
    
            if($request->$ajax())
            {
                return "True request!";
            }
    */
            // Validate the request...
            $result = [];

            if( $request->no ) {
                $partner_apply = \App\Models\PartnerApply::where('app_no', $request->no)->firstOrFail();
            } else {
                $partner_apply = new PartnerApply;
            }

            $partner_apply->app_name = $request->name ?? "";
            $partner_apply->app_address = $request->address ?? "";
            $partner_apply->app_phone = $request->phone ?? "";
            $partner_apply->app_state = $request->state ?? "N";
            $partner_apply->app_title = $request->title ?? "";
            $result['result'] = $partner_apply->save();

             return response($result);




            //
            //return response()->json($result, 200)->setCallback($request->input('callback'));

        }

}
