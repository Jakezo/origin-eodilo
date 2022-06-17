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
use Illuminate\Support\Str;
use App\Models\Custom;
use App\Models\UserAlarm;

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

                    if( $request->fd == "id" ) {
                        $query->where("id", "like", "%".$request->q."%");
                    } elseif( $request->fd == "name" ) {
                        $query->where("name", "like", "%".$request->q."%");
                    } elseif( $request->fd == "email" ) {
                        $query->where("email", "like", "%".$request->q."%");
                    } elseif( $request->fd == "phone" ) {
                        $query->where("phone", "like", "%".$request->q."%");
                    } elseif( $request->fd == "nickname" ) {
                        $query->where("nickname", "like", "%".$request->q."%");
                    } else {
                        $query->where("id", "like", "%".$request->q."%")
                        ->orwhere("name", "like", "%".$request->q."%")
                        ->orwhere("email", "like", "%".$request->q."%")
                        ->orwhere("phone", "like", "%".$request->q."%");
                    }                    

                }
                if( $request->state ) {
                    $query->where("state", $request->state);
                }
            })
            ->orderBy("id","desc")->paginate(10);

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

            if( $user = \App\Models\User::find($request->user_id) ) {
                $result["result"] = false;
                $result["message"] = "이미 존재하는 아이디입니다.";
                return response($result);
            } else if( $user = \App\Models\User::where('email', $request->email)->first() ) {
                $result["result"] = false;
                $result["message"] = "이미 존재하는 이메일입니다.";
                return response($result);
            } else {
                $user = new User();
                $user->id = $request->id;
            }
        }

        
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


    ## 푸쉬발송하기
    public function push_proc(Request $request){

        $data["result"] = true;
        $user = $this->user::where("id",  $request->id)->first();
        

        if( $user ) {

            if( $request->token ) {
                $token = $request->token;
            } else {
                $token = $user->push_token;
            }


            $url = "https://fcm.googleapis.com/fcm/send";
            $serverKey = 'AAAA-GcZL8g:APA91bGUrUi14FUUV949DJr6uh387gXv-G9D8ZIpxq4aV6aBfE4A_x_nCQB4GSAkmVylcCUEfuSwZgje6yt55SDCZPD4zocTiIJQf4Rf3UTgtI47NjU5OJoqXorm-Cv6cUZDP5HCpRHt';
            $notification = array(
                'title' => $request->title , 
                'body' => $request->body, 
                'sound' => 'default', 
                'badge' => '1', 
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK');
            
            $data = [];
            if( $request->pkey ) {
                for( $i=0;$i<=count($request->pkey)-1;$i++){
                        $data[$request->pkey[$i]] = $request->pval[$i];
                }
            } else {
                $data = null;
            }
            
            $arrayToSend = array('to' => $token, 'notification' => $notification, 'data' => $data,  'priority'=> ($request->priority ?? "high") );
            $json = json_encode($arrayToSend);
                     
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            //curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            //Send the request

            ob_start();
            $response = curl_exec($ch);
            $response = ob_get_clean();
            

            //Close request
            if( $response !== FALSE ) {
                    $json = json_decode($response); 

                    $UserAlarm = new \App\Models\UserAlarm;
                    $UserAlarm->a_member = $user->id ?? 0;
                    $UserAlarm->a_kind = "P";
                    $UserAlarm->a_title = $request->title;
                    $UserAlarm->a_body = $request->body;
                    $UserAlarm->a_multicast_id = $json->multicast_id;
                    //$UserAlarm->a_canolical_ids = $json->canolical_ids;


                    if( $json->success == 1 ) {
                        $UserAlarm->a_send = "Y";
                        $UserAlarm->a_message_id = urldecode($json->results[0]->message_id);
                    } else {
                        $UserAlarm->a_send = "N";
                        $UserAlarm->a_message_id = 0;
                    }
                    $UserAlarm->save();

                    echo $response;

            
            } else {
                die(curl_error($ch));
            }
            curl_close($ch);
            
        } else {

        }

    }

    ## 푸쉬발송폼
    public function push_sender(Request $request){

        $data["result"] = true;
        $data["user"] = $this->user::where("id",  $request->id)->first();
        if( $data["user"] ) {

        } else {

        }
        return view('admin.member.userPushSender', $data);
    }


    ## 정보변경폼
    public function info(Request $request){

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
        return view('admin.member.userView', $data);
    }

    ## 구매내역
    public function alarm_list(Request $request){

        $data["result"] = true;
        $data["alarms"] = [];


            $data["alarms"] = \App\Models\UserAlarm::select("user_alarms.*","users.id", "users.name")
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("users.name", "like", "%" . $request->q . "%")
                        ->orwhere("users.nickname", "like", "%" . $request->q . "%")
                        ->orwhere("users.email", "like", "%" . $request->q . "%");
                }
                if ($request->sdate) {
                    $query->where( DB::raw("date_format(user_alarms.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("date_format(user_alarms.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
                }
                if ($request->kind) {
                        $query->where("a_kind", $request->kind);
                }            

            })
            ->leftjoin('users', 'users.id', '=', 'user_alarms.a_member')
            ->orderBy("a_no","desc")->paginate(10);
    
            $data['productType'] = Config::get('product.productType');
    
            $data['start'] = $data["alarms"]->total() - $data["alarms"]->perPage() * ($data["alarms"]->currentPage() - 1);
            $data['total'] = $data["alarms"]->total();
            $data['param'] = [
                'id' => $request->id, 
                'sdate' => $request->sdate, 
                'edate' => $request->edate,  
                'kind' => $request->kind,             
                'fd' => $request->fd, 
                'q' => $request->q];


        return view('admin.member.alarm_list', $data);

    }    


    ## 구매내역
    public function alarms(Request $request){

        $data["result"] = true;
        $data["alarms"] = [];
        $data["user"] = $this->user::where("id",  $request->id)->first();
        if( $data["user"] ) {

            $data["alarms"] = \App\Models\UserAlarm::select("user_alarms.*","users.id", "users.name")
            ->where("a_member",$data["user"]["id"])
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("users.name", "like", "%" . $request->q . "%")
                        ->orwhere("users.nickname", "like", "%" . $request->q . "%")
                        ->orwhere("users.email", "like", "%" . $request->q . "%");
                }
                if ($request->sdate) {
                    $query->where( DB::raw("date_format(user_alarms.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("date_format(user_alarms.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
                }
                if ($request->kind) {
                        $query->where("a_kind", $request->kind);
                }            

            })
            ->leftjoin('users', 'users.id', '=', 'user_alarms.a_member')
            ->orderBy("a_no","desc")->paginate(10);
    
            $data['productType'] = Config::get('product.productType');
    
            $data['start'] = $data["alarms"]->total() - $data["alarms"]->perPage() * ($data["alarms"]->currentPage() - 1);
            $data['total'] = $data["alarms"]->total();
            $data['param'] = [
                'id' => $request->id, 
                'sdate' => $request->sdate, 
                'edate' => $request->edate,  
                'kind' => $request->kind,             
                'fd' => $request->fd, 
                'q' => $request->q];

        } else {

        }
        return view('admin.member.userAlarms', $data);
    }    

    ## 구매내역
    public function products(Request $request){

        $data["result"] = true;
        $data["orders"] = [];
        $data["user"] = $this->user::where("id",  $request->id)->first();
        if( $data["user"] ) {

            $data["orders"] = \App\Models\MobileProductOrder::select("mobile_product_orders.*","users.id", "users.name","partners.p_no", "partners.p_name", "partners.p_id")
            ->where("o_member",$data["user"]["id"])
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("o_member_name", "like", "%" . $request->q . "%");
                            //->orwhere("o_title", "like", "%" . $request->q . "%")
                }
                if ($request->sdate) {
                    $query->where( DB::raw("date_format(mobile_product_orders.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("date_format(mobile_product_orders.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
                }
                if ($request->pkind) {
                        $query->where("o_product_kind", $request->pkind);
                }            
    
                //  if ($request->state) {
                //     if( $request->state == "A" ) {
                //         $query->where("o_duration", "<", "%" . $request->q . "%");
                //     } elseif( $request->state == "N" ) {
                //         $query->where("e_title", "like", "%" . $request->q . "%");
                //     }  elseif( $request->state == "Y" ) {
                //         $query->where("e_cont", "like", "%" . $request->q . "%");
                //     }
    
                //     $query->where("o_state", $request->state);
                //  }         
    
                if ($request->pay_state) {
                    $query->where("o_pay_state", $request->pay_state);
                }
            })
            ->leftjoin('users', 'users.id', '=', 'mobile_product_orders.o_member')
            ->leftjoin('partners', 'partners.p_no', '=', 'mobile_product_orders.o_partner')
            ->orderBy("o_no","desc")->paginate(10);
    
            $data['productType'] = Config::get('product.productType');
    
            $data['start'] = $data["orders"]->total() - $data["orders"]->perPage() * ($data["orders"]->currentPage() - 1);
            $data['total'] = $data["orders"]->total();
            $data['param'] = [
                'id' => $request->id, 
                'sdate' => $request->sdate, 
                'edate' => $request->edate,  
                'pkind' => $request->pkind,             
                'fd' => $request->fd, 
                'q' => $request->q];

        } else {

        }
        return view('admin.member.userProducts', $data);
    }    



    ## 예약내역
    public function reserves(Request $request){

        $data["result"] = true;
        $data["reserves"] = [];
        $data["user"] = $this->user::where("id",  $request->id)->first();
        if( $data["user"] ) {

            $data["reserves"] = \App\Models\MobileReservSeat::where("rv_member",$data["user"]["id"])
            ->select("mobile_reserv_seats.*","mobile_reserv_seats.created_at as reserved_at",
            "partners.p_no","partners.p_id","partners.p_name",
            "users.id","users.nickname","users.email","users.nickname","users.phone", "users.sex", "users.birth" )
                ->leftjoin('partners', 'rv_partner', '=', 'partners.p_no')
                ->leftjoin('users', 'rv_member', '=', 'users.id')
                ->where(function ($query) use ($request) {
                    if ($request->q) {
                        if( $request->fd == "name" ) {
                            $query->where("nickname", "like", "%" . $request->q . "%")
                                ->orwhere("name", "like", "%" . $request->q . "%");                        
                        }  elseif( $request->fd == "id" ) {
                            $query->where("users.id", "like", "%" . $request->q . "%");
                        } else {
                            $query->where("nickname", "like", "%" . $request->q . "%")
                                ->orwhere("name", "like", "%" . $request->q . "%")
                                ->orwhere("users.id", "like", "%" . $request->q . "%");
                        }
                    }
                    if ($request->sdate) {
                        $query->where( DB::raw("date_format(mobile_reserv_seats.rv_sdate,'%Y-%m-%d')"),  ">=", $request->sdate);
                    }
                    if ($request->edate) {
                        $query->where( DB::raw("date_format(mobile_reserv_seats.rv_sdate,'%Y-%m-%d')"),  "<=", $request->edate);
                    }
    
                    if ($request->state) {
    
                        if( $request->state == "A" ) {
                            $query->where("c_sdate",  ">", now());
                        } elseif( $request->state == "I" ) {
                            $query->where("c_sdate",  "<=", now());
                            $query->where("c_edate",  ">=", now());
                        }  elseif( $request->state == "E" ) {
                            $query->where("c_edate",  "<", now());
                        }
    
                    }
                })
                ->orderBy("rv_no","desc")->paginate(10);
    
            $data['query'] = $request->query;
            //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
            $data['start'] = $data["reserves"]->total() - $data["reserves"]->perPage() * ($data["reserves"]->currentPage() - 1);
            $data['total'] = $data["reserves"]->total();
            $data['param'] = [
                    'id' => $request->id, 
                    'sdate' => $request->sdate, 
                    'edate' => $request->edate, 
                    'fd' => $request->fd, 
                    'q' => $request->q];

        } else {

        }

        return view('admin.member.userReserveSeats', $data);
    }    

    ## 예약내역
    public function cashes(Request $request){

        $data["result"] = true;
        $data["cashes"] = [];
        $data["user"] = $this->user::where("id",  $request->id)->first();
        if( $data["user"] ) {

            $data["cash_total"]= \App\Models\User_cash::select(DB::raw("sum(mp_point) as sum"))
            ->where('mp_member', $request->id)
            ->first();

            $data["cashes"] = \App\Models\User_cash::where('mp_member', $request->id)
            ->where(function ($query) use ($request) {
                if( $request->mode == "out" ) {
                    $query->where("mp_point", "<" , 0);
            }elseif( $request->mode == "in" ) {
                    $query->where("mp_point", ">", 0);
            }
            })
            ->orderBy("mp_no","desc")->paginate(10);

            $data['query'] = $request->query;
            //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
            $data['start'] = $data["cashes"]->total() - $data["cashes"]->perPage() * ($data["cashes"]->currentPage() - 1);
            $data['total'] = $data["cashes"]->total();
            $data['param'] = [
                    'id' => $request->id, 
                    'sdate' => $request->sdate, 
                    'edate' => $request->edate, 
                    'fd' => $request->fd, 
                    'q' => $request->q];



        } else {

        }

        return view('admin.member.userCashes', $data);
    }    

    ## 이용문의
    public function customs(Request $request){

        $data["result"] = true;
        $data["customs"] = [];
        $data["user"] = $this->user::where("id",  $request->id)->first();
        if( $data["user"] ) {

            $data["customs"] = \App\Models\Custom::where("q_member",$request->id)
                ->orderBy("q_no","desc")->paginate(10);
        
            $data['query'] = $request->query;
            $data['start'] = $data["customs"]->total() - $data["customs"]->perPage() * ($data["customs"]->currentPage() - 1);
            $data['total'] = $data["customs"]->total();
            $data["customs"]->perPage();
            $data['param'] = [                    'id' => $request->id, 'kind' => $request->kind, 'fd' => $request->fd, 'q' => $request->q];


            $kind_categorys = config("custom.custom_categorys");

            foreach( $data["customs"] as $custom ) {
                $custom->q_kind_text = $kind_categorys[$custom->q_kind];
                $custom->q_cont =  Str::limit($custom->q_cont, 30,"...");
            }

        } else {

        }

        return view('admin.member.userCustoms', $data);
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
