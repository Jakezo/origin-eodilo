<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchContact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Partner;

use Illuminate\Support\Facades\Config;

class FrenchContactController extends Controller
{

    public function __construct()
    {
        $this->partner = new Partner();
        $this->frenchcontact = new FrenchContact();
    }


    ## 목록
    public function index(Request $request){
        //DB::enableQueryLog();	//query log 시작 선언부

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["part"] = [];
        $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();

        $data["frenchcontacts"] = [];
        $data["frenchcontacts"] = $this->frenchcontact->select()
        ->where("c_partner", $data["part"]["p_no"])
        ->where(function ($query) use ($request) {
                if ($request->q) {
                    if( $request->fd == "name" ) {
                        $query->where("c_name", "like", "%" . $request->q . "%");
                    } elseif( $request->fd == "empname" ) {
                        $query->where("c_empname", "like", "%" . $request->q . "%");
                    }  else {
                        $query->where("c_name", "like", "%" . $request->q . "%")
                            ->orwhere("c_empname", "like", "%" . $request->q . "%");
                    }
                }
            })
            ->orderBy("c_no","desc")->paginate(10);

        $data['start'] = $data["frenchcontacts"]->total() - $data["frenchcontacts"]->perPage() * ($data["frenchcontacts"]->currentPage() - 1);
        $data['total'] = $data["frenchcontacts"]->total();
        $data['param'] = ['fd' => $request->fd, 'q' => $request->q];
        return view('partner.article.contact' , $data);
    }
    
    public function update(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["part"] = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first();
        $result = [];
        if( $request->no ) {
            $frenchcontact = \App\Models\FrenchContact::where('c_no', $request->no)->firstOrFail();
        } else {
            $frenchcontact = new FrenchContact();
        }
        $frenchcontact->c_partner = $data["part"]["p_no"] ?? 0;
        $frenchcontact->c_name = $request->name ?? "";
        $frenchcontact->c_empname = $request->empname ?? "";
        $frenchcontact->c_phone= $request->phone ?? "";
        $frenchcontact->c_email = $request->email ?? "";
        $frenchcontact->c_cont = $request->cont ?? "";
     
        if( $frenchcontact->c_no ) {
            $result['result'] = $frenchcontact->update();
        } else {
            $result['result'] = $frenchcontact->save();
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
     
        Config::set('database.connections.partner.database',"boss_".$request->account);
        
        
        $data["result"] = true;
        $data["frenchcontact"] = $this->frenchcontact->select(
                [
                    'c_no as no',
                    'c_name as name',
                    'c_empname as empname',
                    'c_phone as phone',
                    'c_email as email',
                    'c_cont as cont'
                 
                ]
            )
            ->where("c_no",  $request->no)->first();

        return response($data);
    }
}