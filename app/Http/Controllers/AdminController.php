<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    ## 정보수정
    public function update(Request $request)
    {

        // if($request->$ajax())
        // {
        //     $result = [
        //         'result' => false,
        //         'message' => "정상적인 접근이 아닙니다."];
        //     return response($result);
        // }

        // Validate the request...
        $result = [];
        if( $request->no ) {
            $this->admin = \App\Models\Admin::where('admin_no', $request->no)->firstOrFail();
        } else {
            $this->admin = new Admin();
        }
        $this->admin->admin_id = $request->aid;
        $this->admin->admin_name = $request->name ?? "";
        $this->admin->admin_passwd = $request->passwd ? Hash::make($request->passwd) : "";
        $this->admin->admin_email = $request->email ?? "";
        $this->admin->admin_phone = $request->phone ?? "";
        $this->admin->admin_state = $request->state ?? "N";


        if( $request->no ) {
            $this->admin->admin_no = $request->no;
            $exist_admin = \App\Models\Admin::select(["admin_no", "admin_id", "admin_passwd"])
                ->where("admin_id",$request->aid)
                ->where("admin_no",$request->no)
                ->first();
            if( $request->passwd != "" ) $this->admin->admin_passwd = Hash::make($request->passwd);
            if( $exist_admin  ) {
                DB::enableQueryLog();	//query log 시작 선언부
                $result['result'] = $this->admin->save();
                return DB::getQueryLog();
                return response($this->admin);
                return response($result);
            } else {
                $result = [
                    'result' => false,
                    'message' => "정보가 존재하지 않습니다."];
                return response($result);
            }
        } else {
            $exist_admin = \App\Models\Admin::select(["admin_no", "admin_id"])->where("admin_id",$request->aid)->first();
            if( !$exist_admin  ) {
                $result['result'] = $this->admin->save();
                return response($result);
            } else {
                $result = [
                    'result' => false,
                    'message' => "이미 존재하는 아이디입니다."];
                return response($result);
            }
        }

        //
        //return response()->json($result, 200)->setCallback($request->input('callback'));

    }

    ## 삭제
    public function delete(Request $request)
    {
        $result = [];

        if( $request->no ) {
            $this->admin = \App\Models\Admin::where('admin_no', $request->no)->firstOrFail();
            $result['result'] = $this->admin->delete();
        } else {
            $result = [
                'result' => false,
                'message' => "정보가 존재하지 않습니다."];
        }

        return response($result);

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
            $this->admin = \App\Models\Admin::where('admin_no', $request->no)->firstOrFail();
        } else {
            $this->admin = new Admin;
        }

        $this->admin->admin_id = $request->aid;
        $this->admin->admin_name = $request->name ?? "";
        $this->admin->password = $request->passwd ? Hash::make($request->passwd) : "";
        $this->admin->admin_email = $request->email ?? "";
        $this->admin->admin_phone = $request->phone ?? "";
        $this->admin->admin_state = $request->state ?? "N";

        
        if( $this->admin->admin_no ) {

                $result['result'] = $this->admin->update();


                return response($result);            
        } else {
                $result['result'] = $this->admin->save();
                return response($result);
        }

        //
        //return response()->json($result, 200)->setCallback($request->input('callback'));

    }

    ## 목록
    public function index(Request $request){
        $data["q"] = $request->q ?? "";
        $data["admins"] = [];
        $data["admins"] = $this->admin->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    $query->where("admin_id", "like", "%".$request->q."%")
                        ->orwhere("admin_name", "like", "%".$request->q."%")
                        ->orwhere("admin_email", "like", "%".$request->q."%")
                        ->orwhere("admin_phone", "like", "%".$request->q."%");
                }
            })
            ->orderBy("admin_no","desc")->get();

        return view('admin.emp.list', $data);
    }

    ## 폼을 위한 정보
    public function getInfo(Request $request){
        $data["result"] = true;
        $data["admin"] = $this->admin->select(['admin_no as no', 'admin_id as id', 'admin_name as name', 'admin_email as email', 'admin_phone as phone', 'admin_state as state'])
            ->where("admin_no",  $request->no)->first();
        return response($data);
    }

    ## AuthenticatesUsers 트레이트 메서드 오버라이드
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function logout()
    {
        $data["result"] = true;
        $data["auth"] = Auth::guard('admin')->logout();

        return response($data);
    }



    ## 가드지정
    protected function guard()
    {
        return Auth::guard('admin');
    }

}
