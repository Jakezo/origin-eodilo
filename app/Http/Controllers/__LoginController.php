<?php

//namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        #미들웨어 변경, admin 파라미터 전달
        $this->middleware('admin.guest:admin')->except('logout');
    }

    #AuthenticatesUsers 트레이트 메서드 오버라이드
    public function showLoginForm()
    {
        //return view('admin.login');
        return "aa";
        return view('admin.auth.login');
    }

    #가드지정
    protected function guard()
    {
        return Auth::guard('admin');
    }
}