<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchMember;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\User_cash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Carbon;

use Illuminate\Support\Facades\Auth;

class FrenchMemberController extends Controller
{

    public $FrenchMember;
    public $FrenchProductOrder;

    public function __construct()
    {
        $this->FrenchMember = new FrenchMember();
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();
    }


    ## 삭제
    public function delete(Request $request)
    {
        Config::set('database.connections.partner.database',"boss_".$request->account);        
        $result = [];

        if( $request->no ) {
            $FrenchMember = \App\Models\FrenchMember::where('mb_no', $request->no)->firstOrFail();
            $result['result'] = $FrenchMember->delete();
        } else {
            $result = [
                'result' => false,
                'message' => "정보가 존재하지 않습니다."];
        }

        return response($result);

    }

    ## 저장
    public function update(Request $request)
    {      
        Config::set('database.connections.partner.database',"boss_".$request->account);        
/*
        if($request->$ajax())
        {
            return "True request!";
        }
*/

        $result = [];

        if( !$request->name || !$request->phone ) {
            $result = [
                'result' => false,
                'message' => "이름과 핸드폰은 필수항목입니다."
            ]; 
            return response($result);    
        }

        if( $request->no ) {
            
            $FrenchMember = \App\Models\FrenchMember::where('mb_no', $request->no)->first();
            $FrenchMember2 = \App\Models\FrenchMember::where('mb_no', '<>', $FrenchMember->mb_no )->where('mb_phone', $request->phone)->first();
            if( $FrenchMember2 ) {
                $result = [
                    'result' => false,
                    'message' => '중복된 휴대폰이 있습니다.( '.$FrenchMember2->mb_name.' / '.$FrenchMember2->mb_phone.' / '.$FrenchMember2->created_at.' ) '
                ]; 
                return response($result);                
            }   

            $FrenchMember2 = \App\Models\FrenchMember::where('mb_no', '<>', $FrenchMember->mb_no )->where('mb_email', $request->email)->first();
            if( $FrenchMember2 ) {
                $result = [
                    'result' => false,
                    'message' => '중복된 이메일이 있습니다.( '.$FrenchMember2->mb_name.' / '.$FrenchMember2->mb_phone.' / '.$FrenchMember2->created_at.' ) '
                ]; 
                return response($result);                
            }
           

        } else {

            $FrenchMember = \App\Models\FrenchMember::where('mb_name', $request->name)->where('mb_phone', $request->phone)->first();
            if( $FrenchMember ) {
                $result = [
                    'result' => false,
                    'message' => '이미 존재하는 회원입니다.( '.$FrenchMember->mb_name.' / '.$FrenchMember->mb_phone.' / '.$FrenchMember->created_at.' ) '
                ]; 
                return response($result);                
            }              

            $FrenchMember = \App\Models\FrenchMember::where('mb_phone', $request->phone)->first();
            if( $FrenchMember ) {
                $result = [
                    'result' => false,
                    'message' => '중복된 휴대폰이 있습니다.( '.$FrenchMember->mb_name.' / '.$FrenchMember->mb_phone.' / '.$FrenchMember->created_at.' ) '
                ]; 
                return response($result);                
            }
        
 
            $FrenchMember = \App\Models\FrenchMember::where('mb_email', $request->email)->first();
            if( $FrenchMember ) {
                $result = [
                    'result' => false,
                    'message' => '중복된 이메일이 있습니다.( '.$FrenchMember->mb_name.' / '.$FrenchMember->mb_phone.' / '.$FrenchMember->created_at.' ) '
                ]; 
                return response($result);                
            }
 
            $FrenchMember = new FrenchMember;

        } 

        if( !$request->no ) {
            $FrenchMember->mb_id = "mb_".uniqid();
        } 

        $FrenchMember->mb_name = $request->name ?? "";
        if( $request->passwd ) {
            $FrenchMember->password = Hash::make($request->passwd);
        } 


        $FrenchMember->mb_birth = $request->birth ?? "";
        $FrenchMember->mb_sex = $request->sex ?? "";
        $FrenchMember->mb_email = $request->email ?? "";
        $FrenchMember->mb_phone = $request->phone ?? "";
        $FrenchMember->mb_state = $request->state ?? "N"; 

        if( isset($request->tags) ) $FrenchMember->mb_tags = implode(",", $request->tags); 
        else $FrenchMember->mb_tags = "";

        $FrenchMember->mb_memo = $request->memo ?? ""; 

        //DB::enableQueryLog();	//query log 시작 선언부   
        
        if( $FrenchMember->mb_no ) {
            $result['result'] = $FrenchMember->update();
        } else {
            $result['result'] = $FrenchMember->save();
        }
 
        if( $result['result'] ) {
            $result['member'] = [
                'no' => $FrenchMember->mb_no,
                'birth' => $FrenchMember->mb_birth,
                'phone' => $FrenchMember->mb_phone,
                'name' => $FrenchMember->mb_name
            ]; 
        } else {
            $result['message'] = "관리자에게 문의해주세요."; 
        }
        return response($result);

    }

    ## 목록
    public function index(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);        
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["q"] = $request->q ?? "";
        $data["members"] = [];
        $data["members"] = $this->FrenchMember->select()
            ->where(function ($query) use ($request) {
                if ($request->kind) {

                    if( $request->kind == "") {

                    }
                    if( $request->kind == "m") {
                        //$query->where("mb_name", "like", "%".$request->q."%");
                    }
                    if( $request->kind == "p") {
                        //$query->where("mb_phone", "like", "%".$request->q."%");
                    }

                }
                if ($request->fd) {

                    if( $request->fd == "all") {
                        $query->where("mb_name", "like", "%".$request->q."%")
                        ->orwhere("mb_email", "like", "%".$request->q."%")
                        ->orwhere("mb_phone", "like", "%".$request->q."%");
                    }
                    if( $request->fd == "id") {
                        $query->where("mb_id", "like", "%".$request->q."%");
                    }
                    if( $request->fd == "name") {
                        $query->where("mb_name", "like", "%".$request->q."%");
                    }
                    if( $request->fd == "phone") {
                        $query->where("mb_phone", "like", "%".$request->q."%");
                    }
                    if( $request->fd == "email") {
                        $query->where("mb_email", "like", "%".$request->q."%");
                    }

                }

           
            })
            ->orderBy("mb_no","desc")->paginate(10);
        //dd(DB::getQueryLog());

        $data['query'] = $request->query;
        //$i = $this->board->perPage() * ($this->board->currentPage() - 1);
        $data['start'] = $data["members"]->total() - $data["members"]->perPage() * ($data["members"]->currentPage() - 1);
        $data['total'] = $data["members"]->total();
        $data['param'] = ['state' => $request->state, 'fd' => $request->fd, 'q' => $request->q];



        return view('partner.member.list', $data);
    }    
    
    ## 목록
    public function search(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);        
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["q"] = $request->q ?? "";
        $data["members"] = [];
        $data["members"] = $this->FrenchMember->select(["mb_no","mb_name","mb_sex","mb_birth","mb_phone","mb_tags"])
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("mb_name", "like", "%".$request->q."%")
                        ->orwhere("mb_email", "like", "%".$request->q."%")
                        ->orwhere("mb_phone", "like", "%".$request->q."%");
                }
          
            })
            ->orderBy("mb_no","desc")->get();

        return response($data);
    } 

    ## 폼을 위한 정보
    public function getInfo(Request $request){
        Config::set('database.connections.partner.database',"boss_".$request->account);



        $data["result"] = true;
        $data["member"] = $this->FrenchMember->select([
            'mb_no as no', 
            'mb_id as id', 
            'mb_name as name', 
            'mb_birth as birth', 
            'mb_email as email', 
            'mb_phone as phone', 
            'mb_state as state'])
            ->where("mb_no",  $request->no)->first();

        if( $data['member']['birth'] && $data['member']['birth']!="0000-00-00" ) {
            $data['member']['age'] = \Carbon\Carbon::createFromFormat('Y-m-d', $data['member']['birth'])->age;
            if( $data['member']['age'] > 18 ) $data['member']['ageType'] = "A";
            else $data['member']['ageType'] = "S";
        } else {
            $data['member']['ageType'] = "A";
        }
        if( $data['member']['ageType'] == "A") {
            $data['member']['ageTypeText'] = "성인";
        } elseif( $data['member']['ageType'] == "S") {
            $data['member']['ageTypeText'] = "학생";
        }
        response($data['member']);

        return response($data);
    }    


    ## 폼을 위한 정보
    public function viewInfo(Request $request){
        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["member"] = $this->FrenchMember->select([
            'mb_no as no', 
            'mb_id as id', 
            'mb_name as name', 
            'mb_birth as birth',
            'mb_tags as tags', 
            'mb_email as email', 
            'mb_phone as phone', 
            'mb_sex as sex', 
            'mb_state as state', 
            'mb_memo as memo'])
            ->where("mb_no",  $request->no)->first();

            $data["orders"] = $this->FrenchProductOrder::where("o_member", $request->no)
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("o_member_name", "like", "%" . $request->q . "%");
                            //->orwhere("o_title", "like", "%" . $request->q . "%")
                }
                if ($request->sdate) {
                    $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  ">=", $request->sdate);
                }
                if ($request->edate) {
                    $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m-%d')"),  "<=", $request->edate);
                }
            })
            ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_product_orders.o_member')
            ->orderBy("o_no","desc")->get();


            $data["reservs"] = $this->FrenchReservSeat::where("rv_member", $request->no)->where("rv_member_from", "<>","M")
            ->select(['french_reserv_seats.*','french_rooms.r_name','french_seats.s_name'])
            ->where(function ($query) use ($request) {
                if ($request->q) {
                        $query->where("rv_member_name", "like", "%" . $request->q . "%");
                            //->orwhere("o_title", "like", "%" . $request->q . "%")
                }
                if ($request->sdate) {
    
                    $query->where(DB::raw("date_format(rv_sdate,'%Y-%m-%d')"), ">=", $request->sdate)
                    ->orWhere(DB::raw("date_format(rv_edate,'%Y-%m-%d')"), '>=', $request->sdate);   
                }
                if ($request->edate) {
    
                    $query->where(DB::raw("date_format(rv_sdate,'%Y-%m-%d')"), "<=", $request->edate)
                    ->orWhere(DB::raw("date_format(rv_edate,'%Y-%m-%d')"), '<=', $request->edate);                   
                }
    
                if ($request->pkind) {
                        $query->where("o_product_kind", $request->pkind);
                }            
    
                if ($request->pay_state) {
                    $query->where("o_pay_state", $request->pay_state);
                }
            })
            ->leftjoin('french_rooms', 'french_rooms.r_no', '=', 'french_reserv_seats.rv_room')
            ->leftjoin('french_seats', 'french_seats.s_no', '=', 'french_reserv_seats.rv_seat')
            ->orderBy("rv_no","desc")->get();

            // $data["cash_total"]= \App\Models\User_cash::select(DB::raw("sum(mp_point) as sum"))
            // ->where('mp_member', $request->no)
            // ->first();

            // $data["cashes"] = \App\Models\User_cash::where('mp_member', $request->no)
            // ->where(function ($query) use ($request) {
            //     if( $request->mode == "out" ) {
            //         $query->where("mp_point", "<" , 0);
            // }elseif( $request->mode == "in" ) {
            //         $query->where("mp_point", ">", 0);
            // }
            // })
            // ->orderBy("mp_no","desc")
            // ->get();



        if( $data['member']['birth'] && $data['member']['birth']!="0000-00-00" ) {
            $data['member']['age'] = \Carbon\Carbon::createFromFormat('Y-m-d', $data['member']['birth'])->age;
            if( $data['member']['age'] > 18 ) $data['member']['ageType'] = "A";
            else $data['member']['ageType'] = "S";
        } else {
            $data['member']['ageType'] = "A";
        }
        if( $data['member']['ageType'] == "A") {
            $data['member']['ageTypeText'] = "성인";
        } elseif( $data['member']['ageType'] == "S") {
            $data['member']['ageTypeText'] = "학생";
        }
        if( $data['member']['tags'] ) {
            $data['member']['tags_arr'] = explode(",",$data['member']['tags']);
        } else {
            $data['member']['tags_arr'] = [];
        }
        
        return view('partner.member.popupView', $data);
    }  

    ## 폼을 위한 정보
    public function regForm(Request $request){
        Config::set('database.connections.partner.database',"boss_".$request->account);

        $data["result"] = true;
        $data["nextStep"] = $request->nextStep;
        
        return view('partner.member.popupView', $data);
    }  
    

    
    ## 회원의 구매내역
    public function productsList(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);        
        //DB::enableQueryLog();	//query log 시작 선언부

        $data["result"] = true;
        $data["products"] = [];
        $data["products"] = $this->FrenchProductOrder->where("o_member",$request->no)->orderBy("o_no","desc")->get();

        $productType = config('product.productType');

        for( $i = 0; $i<=count($data["products"])-1; $i++ ) {

            if( $data["products"][$i]['o_product_kind'] == "P" )  {
                $duration = $data["products"][$i]['o_duration'] . "원";
            } if( $data["products"][$i]['o_product_kind'] == "T" )  {
                $data["products"][$i]['o_remainder'] = $data["products"][$i]['o_remainder_time'];
                $duration = $data["products"][$i]['o_remainder_time'] . "/" . $data["products"][$i]['o_duration'] . "시간";
            } else {
                $data["products"][$i]['o_remainder'] = $data["products"][$i]['o_remainder_day'];
                $duration = $data["products"][$i]['o_remainder_day'] . "/" . $data["products"][$i]['o_duration'] . "일";
            }

            // $data["products"][$i]['o_product_name'] = $productType[$data["products"][$i]['o_product_kind']] . "( ".$duration." )";   
            
            $data["products"][$i]['o_product_name'] = $productType[ $data["products"][$i]['o_product_kind'] ]. "(".$duration.")";    

 
        }

        return response($data);
    }    


    ## 회원 구매 상품상태
    public function productState(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);        
        //DB::enableQueryLog();	//query log 시작 선언부

        if( !$request->m ) {
            $result = [
                "result" => false,
                "message" => "이용자를 선택해 주세요."];
            return response($result);
        }
        if( !$request->s ) {
            $result = [
                "result" => false,
                "message" => "좌석을 선택해 주세요."];
            return response($result);
        }
        if( !$request->o ) {
            $result = [
                "result" => false,
                "message" => "이용자의 상품을 선택해 주세요."];
            return response($result);
        }

        $data["result"] = true;
        $data["product"] = $this->FrenchProductOrder
            ->where("o_member",$request->m)
            ->where("o_no",$request->o)->orderBy("o_no","desc")->first();

        if( $data["product"]['o_product_kind'] == "P" )  {
            $data["product"]['o_remainder']  = $data["product"]['o_remainder_point'];
        } else if( $data["product"]['o_product_kind'] == "D" || $data["product"]['o_product_kind'] == "A" )  {
            $data["product"]['o_remainder']  = $data["product"]['o_remainder_day'];
        } else if( $data["product"]['o_product_kind'] == "T" )  {
            $data["product"]['o_remainder']  = $data["product"]['o_duration_time'];
        }

        return response($data);            

    }    


        ## 알람목록
        public function alarm_list(Request $request){

            Config::set('database.connections.partner.database',"boss_".$request->account); 
            
            $partner = \App\Models\Partner::select("p_no","p_id","p_name")->where('p_id', $request->account)->first(); 

            $data["result"] = true;
            $data["alarms"] = [];
                $data["alarms"] = \App\Models\UserAlarm::where("a_partner", $partner->p_no)
                ->select("user_alarms.*","users.id", "users.name", "partners.p_name")
                ->leftJoin("partners", "partners.p_no","user_alarms.a_partner")
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
    
    
            return view('partner.member.sms_list', $data);
    
        }  


    ## 회원의 팝업정보

    #1. 구매내역
    public function member_buyProducts(Request $request){

        Config::set('database.connections.partner.database',"boss_".$request->account);        
        //DB::enableQueryLog();	//query log 시작 선언부


        $data["result"] = true;
        $data["orders"] = $this->FrenchProductOrder
            ->where("o_member",$request->no)->orderBy("o_no","desc")
            ->orderBy("o_no","desc")->paginate(10);
        dd($data["orders"]);
        
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

        foreach( $data["orders"] as $order ) {
            if( $order['o_product_kind'] == "P" )  {
                $order['o_remainder']  = $order['o_remainder_point'];
            } else if( $order['o_product_kind'] == "D" || $order['o_product_kind'] == "A" )  {
                $order['o_remainder']  = $order['o_remainder_day'];
            } else if( $order['o_product_kind'] == "T" )  {
                $order['o_remainder']  = $order['o_duration_time'];
            }
        }

        return response($data);            

    }    
}
