<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User_cash;
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

class MobileCashController extends Controller
{
    public function __construct()
    {
        $this->cashes = new User_cash();
    }

    public function index(Request $request){



        if(Auth::guard('user')->check()){
        $data = [];

        $data["cash_total"]=$this->cashes->select(DB::raw("sum(mp_point) as sum"))
        ->where('mp_member', Auth::guard('user')->user()->id)
        ->first();



        $data["cashes"] = $this->cashes->select("*", DB::raw("DATE_FORMAT(created_at ,'%Y-%m-%d') as date"))
        ->where('mp_member', Auth::guard('user')->user()->id)
        ->where(function ($query) use ($request) {
            if( $request->mode == "out" ) {
                $query->where("mp_point", "<" , 0);
           }elseif( $request->mode == "in" ) {
                $query->where("mp_point", ">", 0);
           }
        })
        ->orderBy("created_at")
        ->paginate(10);


        $data["mode"]= $request->mode;
        // dd($data["cashes"]);


        return view('mobile.my_cash',$data);

        }else{
        return redirect('signin');
        }
    }


    public function withdraw(Request $request){



        if(Auth::guard('user')->check()){
        $data = [];

        $data["cashtotal"]=$this->cashes->select(DB::raw("sum(mp_point) as sum"))
        ->where('mp_member', Auth::guard('user')->user()->id)
        ->first();




        return view('mobile.my_cash_withdraw', $data);

        }else{
        return redirect('signin');
        }
    }
    public function charge1(Request $request){



        if(Auth::guard('user')->check()){



        return view('mobile.my_cash_charge1');

        }else{
        return redirect('signin');
        }
    }
    public function charge2(Request $request){

        if(Auth::guard('user')->check()){
        $data["cashes2"] = $this->cashes->select(DB::raw("sum(mp_point) as sum","*"))
        ->where('mp_member', Auth::guard('user')->user()->id)
        ->first();

        $data["cash"]= $request->cash;




        return view('mobile.my_cash_charge2',$data);

        }else{
        return redirect('signin');
        }
    }

    // public function charge4(Request $request){

    //     if(Auth::guard('user')->check()){

    //     return view('mobile.my_cash_charge4');

    //     }else{
    //     return redirect('signin');
    //     }
    // }

    public function charge5(Request $request){

        if(Auth::guard('user')->check()){

        $data["no"]= $request->no;


        $data["cashes5"] = $this->cashes->select()
        ->where('mp_no', $data["no"])
        ->where('mp_member', Auth::guard('user')->user()->id)
        ->first();



        return view('mobile.my_cash_charge5',$data);

        }else{
        return redirect('signin');
        }
    }

    public function update(Request $request){

        if(Auth::guard('user')->check()){


        $result = [];
        $cashes = new User_cash();


        $cashes->mp_member = Auth::guard('user')->user()->id;
        $cashes->mp_point = $request->charge1;
        $cashes->mp_contents = $request->cont ?? "임시내용";

        $result['result'] = $cashes->save();

        $result['no']=$cashes->mp_no;


        return response($result);
    }else{
        return redirect('signin');
    }
}



}
