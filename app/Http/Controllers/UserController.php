<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    ## 목록
    public function index(Request $request){
        $data["users"] = [];
        $data["users"] = $this->user->select()
            ->where(function ($query) use ($request) {
                if ($request->q) {

                    if( $request->fd == "user_id" ) {
                        $query->where("user_id", "like", "%".$request->q."%");
                    } elseif( $request->fd == "name" ) {
                        $query->where("name", "like", "%".$request->q."%");
                    } elseif( $request->fd == "email" ) {
                        $query->where("email", "like", "%".$request->q."%");
                    } elseif( $request->fd == "phone" ) {
                        $query->where("phone", "like", "%".$request->q."%");
                    } elseif( $request->fd == "nickname" ) {
                        $query->where("nickname", "like", "%".$request->q."%");
                    } else {
                        $query->where("user_id", "like", "%".$request->q."%")
                        ->orwhere("name", "like", "%".$request->q."%")
                        ->orwhere("email", "like", "%".$request->q."%")
                        ->orwhere("phone", "like", "%".$request->q."%");
                    }                    

                }
                if( $request->state ) {
                    $query->where("state", $request->state);
                }
            })
            ->orderBy("id","desc")->paginate(10)->setPath('')->appends(request()->query());

        foreach( $data["users"] as $user ) {
            if( $user->birth ) {
                
                $user->age = \Carbon\Carbon::createFromFormat('Y-m-d', $user->birth )->age; 
                if( $user->age > 18 ) {
                    $user->ageType = "A";
                    $user->ageTypeText = "성인";
                } else  {
                    $user->ageType = "S";
                    $user->ageTypeText = "학생";
                }
            } else {
                $user->age = 0; 
                $user->ageType = "A";
                $user->ageTypeText = "성인";
            }
        }

        $data['total'] = $data["users"]->total();
        $data['start'] = $data["users"]->total() - $data["users"]->perPage() * ($data["users"]->currentPage() - 1);
        $data['param'] = ['state' => $request->state, 'last' => $request->last, 'area' => $request->area, 'fd' => $request->fd, 'q' => $request->q];
        return view('admin.member.list',$data);
    }

    public function update(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        //dd(DB::getQueryLog());

        $result = [];
        if( $request->id ) {
            $user = \App\Models\User::where('id', $request->id)->first();
        } else {

            $validatedData = $request->validate([
                'user_id' => 'bail|required|min:6|max:20',
                'name' => 'bail|required'
            ]);

            if( $user = \App\Models\User::where('user_id', $request->user_id)->first() ) {
                $result["result"] = false;
                $result["message"] = "이미 존재하는 아이디입니다.";
                return response($result);
            } else if( $user = \App\Models\User::where('email', $request->email)->first() ) {
                $result["result"] = false;
                $result["message"] = "이미 존재하는 이메일입니다.";
                return response($result);
            } else {
                $user = new User();
            }
        }

        $user->user_id = $request->user_id;
        if( $request->passwd ) $user->password = Hash::make($request->passwd) ?? "";
        $user->name = $request->name ?? "";
        $user->phone = $request->phone ?? "";
        $user->email = $request->email ?? "";
        $user->nickname = $request->nickname ?? "";
        $user->birth = $request->birth ?? "";
        $user->sex = $request->sex ?? "";
        $user->memo = $request->memo ?? "";
        $user->state = $request->state ?? "N";

        if( $user->id ) {
            $result['result'] = $user->update();
        } else {
            $result['result'] = $user->save();
        }

        if( $request->rURL ) {
            $result['rURL'] = $request->rURL;
        } else {
            $result['rURL'] = "";
        }

        return response($result);
    }

    ## 폼을 위한 정보
    public function form(Request $request){

        $data["result"] = true;
        $data["user"] = $this->user::where("id",  $request->id)->first();
        if( $data["user"] ) {

        if( $data['user']['birth'] && $data['user']['birth']!="0000-00-00" ) {
            $data['user']['age'] = \Carbon\Carbon::createFromFormat('Y-m-d', $data['user']['birth'])->age;
            if( $data['user']['age'] > 18 ) $data['user']['ageType'] = "A";
            else $data['user']['ageType'] = "S";
        } else {
            $data['user']['ageType'] = "A";
        }
        if( $data['user']['ageType'] == "A") {
            $data['user']['ageTypeText'] = "성인";
        } elseif( $data['user']['ageType'] == "S") {
            $data['user']['ageTypeText'] = "학생";
        }

        } else {

        }
        return view('admin.member.form', $data);
    }


    # API.가맹점 목록을 얻음
    public function get_list(Request $request){
        $data["result"] = true;
        $data["users"] = $this->user->select(["p_no", "p_name"])
            ->where("p_state", "Y")
            ->orderBy("p_name","desc")->get();

        if( $data["users"] ) {
            $data["result"] = true;
        } else {
            $data["result"] = false;
        }

        return response($data);
    }
  

    ## 목록
    public function search(Request $request){

        $data["q"] = $request->q ?? "";
        $data["users"] = $this->user->select(["p_no as no", "p_name as name", "p_address1 as area", "p_phone as phone"])
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("p_name", "like", "%".$request->q."%")
                        ->orwhere("p_email", "like", "%".$request->q."%")
                        ->orwhere("p_phone", "like", "%".$request->q."%");
                }
          
            })
            ->orderBy("p_name","asc")->get();

        return response($data);
    } 

    // 회원가입을 위해


    // 로그인 인증을 위하여 
    # 1. 핸드폰번호 중복
    public function checkDupPhone(Request $request){

        $data["result"] = true;

        if( $exist_user = $this->user::where("phone",  $request->phone)->first() ) {

            // 회원없음
            $result = [
                "result" => false,
                "message" => "이미 이용중인 휴대폰 번호입니다."
            ]; 
        } else {
            // 비번발송
            $result = [
                "result" => true,
                "message" => "이용 가능한 휴대폰번호 입니다."
            ];        
        }

        return response($result );
    }
    # 1. 이메일 중복
    public function checkDupEmail(Request $request){

        $data["result"] = true;

        if( $exist_user = $this->user::where("email",  $request->email)->first() ) {

            // 회원없음
            $result = [
                "result" => false,
                "message" => "이미 이용중인 이메일입니다."
            ]; 
        } else {
            // 비번발송
            $result = [
                "result" => true,
                "message" => "이용 가능한 이메일 입니다."
            ];        
        }

        return response($result );
    }
    # 1. 닉네임 중복
    public function checkDupNickName(Request $request){

        $data["result"] = true;

        if( $exist_user = $this->user::where("nickname",  $request->nickname)->first() ) {

            // 회원없음
            $result = [
                "result" => false,
                "message" => "이미 이용중인 닉네임입니다."
            ]; 
        } else {
            // 비번발송
            $result = [
                "result" => true,
                "message" => "이용 가능한 닉네임입니다."
            ];        
        }

        return response($result );
    }

    # 1. 인증번호발송
    public function checkPhoneNo(Request $request){

        $data["result"] = true;

        if( $exist_user = $this->user::where("phone",  $request->phone)->first() ) {
            $exist_user->phone_pass = mt_rand(100000, 999999);

            $exist_user->phone_pass_at = \Carbon\Carbon::now()->addMinutes(3);
            $exist_user->update();

            // 비번발송
            $result = [
                "result" => true,
                "message" => "인증번호를 발송하였습니다.".$exist_user->phone_pass
            ];
        } else {
            // 회원없음
            $result = [
                "result" => false,
                "message" => "회원정보가 없습니다."
            ];         
        }

        return response($result );
    }


    # 2. 인증번호확인
    public function checkPhoneAuth(Request $request){

        $data["result"] = true;

        if( $exist_user = $this->user::where("phone",  $request->phone)->first() ) {

            if( $exist_user->phone_pass_at > \Carbon\Carbon::now() ) {

                if( $exist_user->phone_pass == $request->phone_pass ) {

                    // 비번발송
                    $result = [
                        "result" => true,
                        "message" => "일치합니다."
                    ];

                } else {

                    // 회원없음
                    $result = [
                        "result" => false,
                        "message" => "인증번호가 일치하지 않습니다."
                    ];  

                }

            } else {
                // 비번발송
                $result = [
                    "result" => true,
                    "message" => "승인제한시간이 종료되었습니다. 다시 인증번호를 수신을 눌러주세요."
                ];
            }


        } else {
            // 회원없음
            $result = [
                "result" => false,
                "message" => "회원정보가 없습니다."
            ];         
        }

        return response($result );
    }    

    public function registForm(Request $request){
        $data = [];
        return view('mobile.regform', $data);
    }

    public function regist(Request $request){

        $user = new User();

        if( $user::where("phone",  $request->phone)->first() ) {

            // 회원없음
            $result = [
                "result" => false,
                "message" => "이미 이용중인 휴대폰 번호입니다."
            ]; 
            return response($result );
        }

        if( $user::where("email",  $request->email)->first() ) {

            // 회원없음
            $result = [
                "result" => false,
                "message" => "이미 이용중인 이메일입니다."
            ]; 
            return response($result );
        } 

        if( $user::where("nickname",  $request->nickname)->first() ) {

            // 회원없음
            $result = [
                "result" => false,
                "message" => "이미 이용중인 닉네임입니다."
            ]; 
        }

        if( !$request->password ) {

            // 회원없음
            $result = [
                "result" => false,
                "message" => "패스워드를 반드시 입력해주세요."
            ]; 
            return response($result );
        }

        if( $request->password ) $user->password = Hash::make($request->password) ?? "";
        $user->name = $request->name ?? "";
        $user->phone = $request->phone ?? "";
        $user->email = $request->email ?? "";
        $user->nickname = $request->nickname ?? "";
        $user->birth = $request->birth ?? "";
        $user->sex = $request->sex ?? "";

        $result['result'] = $user->save();
        return response($result );
    
    }

}
