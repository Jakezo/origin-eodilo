<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Auth;

class FrenchManagerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $manager;

    public function __construct()
    {
        $this->manager = new FrenchManager();
    }

    ## 정보수정
    // public function update(Request $request)
    // {
    //     Config::set('database.connections.partner.database',"boss_".$request->account);
    //     if($request->ajax())
    //     {
    //         $result = [
    //             'result' => false,
    //             'message' => "정상적인 접근이 아닙니다."];
    //         return response($result);
    //     }

    //     // Validate the request...
    //     $result = [];

    //     if( $request->no ) {
    //         $manager = \App\Models\FrenchManager::where('mn_no', $request->no)->firstOrFail();
    //     } else {
    //         $manager = new \App\Models\FrenchManager;
    //     }

    //     $manager->mn_id = $request->aid;
    //     $manager->mn_name = $request->name ?? "";
    //     if( $request->passwd ) {
    //         $manager->password = Hash::make($request->passwd);
    //     }         
    //     $manager->mn_email = $request->email ?? "";
    //     $manager->mn_phone = $request->phone ?? "";
    //     $manager->mn_state = $request->state ?? "N";
    //     if( $request->no ) {
    //         $manager->mn_no = $request->no;
    //         $exist_admin = \App\Models\FrenchManager::select(["mn_no", "mn_id", "mn_passwd"])
    //             ->where("mn_id",$request->aid)
    //             ->where("mn_no",$request->no)
    //             ->first();
    //         if( $request->passwd == "" ) $manager->mn_passwd = $exist_admin->mn_passwd;
    //         if( $exist_admin  ) {
    //             $result['result'] = $manager->save();
    //             return response($result);
    //         } else {
    //             $result = [
    //                 'result' => false,
    //                 'message' => "정보가 존재하지 않습니다."];
    //             return response($result);
    //         }
    //     } else {
    //         $exist_FranchManager = \App\Models\FrenchManager::select(["mn_no", "mn_id"])->where("mn_id",$request->aid)->first();
    //         if( !$exist_FranchManager  ) {
    //             $result['result'] = $manager->save();
    //             return response($result);
    //         } else {
    //             $result = [
    //                 'result' => false,
    //                 'message' => "이미 존재하는 아이디입니다."];
    //             return response($result);
    //         }
    //     }

    //     //
    //     //return response()->json($result, 200)->setCallback($request->input('callback'));

    // }

    ## 삭제
    public function delete(Request $request)
    {
        Config::set('database.connections.partner.database',"boss_".$request->account);        
        $result = [];

        if( $request->no ) {
            $manager = \App\Models\FrenchManager::where('mn_no', $request->no)->firstOrFail();
            $result['result'] = $manager->delete();
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
        Config::set('database.connections.partner.database',"boss_".$request->account);        
/*
        if($request->$ajax())
        {
            return "True request!";
        }
*/
        $result = [];

        if( $request->no ) {
            $manager = \App\Models\FrenchManager::where('mn_no', $request->no)->firstOrFail();
        } else {
            $manager = new FrenchManager;
            $manager->mn_id = $request->aid ?? "";
        }
  
        $manager->mn_name = $request->name ?? "";
        if( $request->passwd ) {
            $manager->password = Hash::make($request->passwd);
        } 
           

        $manager->mn_email = $request->email ?? "";
        $manager->mn_phone = $request->phone ?? "";
        $manager->mn_state = $request->state ?? "N"; 


        //DB::enableQueryLog();	//query log 시작 선언부   
        
        if( $manager->mn_no ) {
            $result['result'] = $manager->update();
        } else {
            $result['result'] = $manager->save();
   
        }

        $result = [
            'result' => true,
            'message' => $manager];
        return response($result);
        if( !$result['result'] ) {
            $result['message'] = "관리자에게 문의해주세요."; 
        }
        return response($result);

        return response($result);
        //
        //return response()->json($result, 200)->setCallback($request->input('callback'));

    }

    ## 목록
    public function index(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);        
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["q"] = $request->q ?? "";
        $data["admins"] = [];
        $data["admins"] = $this->manager->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    $query->where("mn_id", "like", "%".$request->q."%")
                        ->orwhere("mn_name", "like", "%".$request->q."%")
                        ->orwhere("mn_email", "like", "%".$request->q."%")
                        ->orwhere("mn_phone", "like", "%".$request->q."%");
                }
            })
            ->orderBy("mn_no","desc")->get();
        //dd(DB::getQueryLog());

        return view('partner.setting.emp', $data);
    }

    ## 폼을 위한 정보
    public function getInfo(Request $request){
        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["admin"] = $this->manager->select(['mn_no as no', 'mn_id as aid', 'mn_name as name', 'mn_email as email', 'mn_phone as phone', 'mn_state as state'])
            ->where("mn_no",  $request->no)->first();
        return response($data);
    }

    ## AuthenticatesUsers 트레이트 메서드 오버라이드
    public function showLoginForm()
    {
        return view('partner.auth.login');
    }

    public function logout()
    {
        $data["result"] = true;
        $data["auth"] = Auth::guard('manager')->logout();

        return response($data);
    }

    ## 가드지정
    protected function guard()
    {
        return Auth::guard('admin');
    }

}
