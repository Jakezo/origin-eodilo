<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    //protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = "/partner";

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        //$this->middleware('guest:admin')->except('logout');
        //$this->middleware('guest:partner')->except('logout');
     }

    // 아래의 username을 추가하여 이메일 로그인에서 아이디 로그인으로 변경.
    public function username()
    {
        return 'admin_id'; // 필드의 네임을 여러분의 선택.
    }

    /* 시스템 관리자 */
    public function showAdminLoginForm()
    {
        return view('admin.auth.login', ['url' => 'adminlogin2']);// 파라미터는 확인용으로 그냥 넣어본거
    }

    public function adminLogin(Request $request)
    {

        if( $admin = \App\Models\Admin::where('admin_id', $request->login_id)->first() ) {
            if (Auth::guard('admin')->attempt(['admin_id' => $request->login_id, 'password' => $request->login_pw], $request->get('remember'))) {

                //redirect()->intended('/index2'); //요거는 계속 header 문제를 일으킴.
                return redirect()->route('adminhome'); //요거도 마찬가지네 그려.
            } else {
                return back()->withErrors(['msg' => '패스워드가 일치하지 않습니다.'])->withInput($request->only('login_id', 'remember'));

            }
        } else {
            return back()->withErrors(['msg' => '아이디가 존재하지 않습니다.']);

        }

    }

   
    /* 일반유저 */
    public function showUserLoginForm()
    {
        return view('mobile.login', ['url' => 'userlogin']);// 파라미터는 확인용으로 그냥 넣어본거
    }

    public function userLogin(Request $request)
    {
        if( $request->login_email ) {
            // 존재하지 않는 이메일
            
            // 로그인실행
            if (Auth::attempt(['email' => $request->login_email, 'password' => $request->login_pw], true)) {

                redirect()->intended('/index2'); //요거는 계속 header 문제를 일으킴.
                return redirect()->route('userhome'); //요거도 마찬가지네 그려.


                $user = \App\Models\User::where('email', $request->login_email)->first();

                $result = [ "result" => true, "token" => $user->createToken('test')->plainTextToken ];
                return response($result); 
            }
           
            return back()->withInput($request->only('login_email', 'remember'));
        }


        if( $request->phone ) {  

            $user = \App\Models\User::where('phone', $request->phone)->where('phone_pass', $request->phone_pass)->first();
            if( $user->phone_pass_at > \Carbon\Carbon::now() ) {

                if( $user->phone_pass == $request->phone_pass ) {


                    if( Auth::user() ) {
                        $result = [ "result" => true, "token" => $user->createToken('test')->plainTextToken ];
                    } else {
                        $result = [ "result" => false, "message" => "정상적으로 로그인이 되지 않았습니다." ];
    
                    }

                } else {

                    // 회원없음
                    $result = [ 
                        "result" => false,
                        "message" => "인증번호가 일치하지 않습니다."
                    ];  

                }

            } else {
                    // 회원없음
                    $result = [ 
                        "result" => false,
                        "message" => "인증번호기간이 만료되었습니다."
                    ];
            }

            return response($result );

        }

        //return back()->withInput($request->only('user_id', 'remember'));
    }


    public function userlogout()
    {
        $data["result"] = true;
        $data["auth"] = Auth::logout();

        return response($data);
    }  
}
