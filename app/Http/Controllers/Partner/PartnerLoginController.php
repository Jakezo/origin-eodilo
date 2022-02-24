<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerLoginController extends Controller
{


    public function authenticate(Request $request)
    {
        $credentials = [ "p_id" => $request->id ,"p_passwd" => $request->passwd ];

        if (Auth::guard('partners')->attempt($credentials)) {
            // Authentication passed...
            //return redirect()->intended('dashboard');
            $return = ["result"=>true];
        } else {
            $return = ["result"=>false, "message" => "로그인정보가 정확하지 않습니다."];
        }
        return response($return);
    }

}
