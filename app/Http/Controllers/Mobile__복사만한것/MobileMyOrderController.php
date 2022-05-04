<?php
namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Partner;
use App\Models\FrenchSeat;
use App\Models\FrenchSeatLevel;
use App\Models\FrenchLocker;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\FrenchRoom;
use App\Models\FrenchIot;
use App\Models\Partner_review;
use App\Models\PartnerPhoto;
use App\Models\PartnerCoupon;
use App\Models\UserCoupon;

use App\Models\MobileProductOrder;
use App\Models\MobileReservSeat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Http\Controllers\Mobile\MobilePartnerController;
use App\Http\Classes\Iot;


class MobileMyOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $partner;

    public function __construct(Request $request)
    {
        $this->partner = new Partner();
        $this->FrenchRoom = new FrenchRoom();
        $this->FrenchSeat = new FrenchSeat();
        $this->FrenchIot = new FrenchIot();
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();
        $this->FrenchLocker = new FrenchLocker();

        $this->MobileProductOrder  = new MobileProductOrder();
        $this->MobileReservSeat  = new MobileReservSeat();

        $this->Partner_review = new Partner_review();
        $this->PartnerCoupon = new PartnerCoupon();

    }

    // 예약
    public function reserveSettingMenu(Request $request){
        $data = [];

        $this->MobileReservSeat = MobileReservSeat::find($request->rv);
        $data["partner"] = Partner::find($this->MobileReservSeat->rv_partner);

        Config::set('database.connections.partner.database',"boss_".$data["partner"]->p_id);
        $data["reserv"] = FrenchReservSeat::find($this->MobileReservSeat->rv_partner_rv);
        $data["room"] = FrenchRoom::select("r_no", "r_iot1")->find($data["reserv"]->rv_room);

        $data["seat"] = FrenchSeat::select("s_no", "s_iot_ext")->find($data["reserv"]->rv_seat);

        $iot_ext = explode(",",$data["seat"]->s_iot_ext);

        $data["iots"] = FrenchIot::select("i_no", "i_name", "i_iot1", "i_iot2", "i_iot3", "i_iot4")->whereIn("i_no", $iot_ext)->get();

        // 개발을 위해 무조건..
        if( $data["reserv"]->rv_state_seat ) {

            $r_sdt = Carbon::createFromFormat('Y-m-d H:i:s', $data["reserv"]->rv_sdate );
            $r_edt = Carbon::createFromFormat('Y-m-d H:i:s', $data["reserv"]->rv_edate );
            $n_dt = Carbon::now();


            if(  $n_dt < $r_edt ) {  // 시간제한을 두면 좋을것 같음.
                $data["enable_change_time"] = true;
                $data["enable_change_seat"] = true;
                $data["is_end"] = false;
            } else {
                $data["enable_change_time"] = false;
                $data["enable_change_seat"] = false;
                $data["is_end"] = true;
            }
        } else {
            $data["enable_change_time"] = false;
            $data["enable_change_seat"] = false;
            $data["is_end"] = false;
        }


        return view('mobile.voucher_settingMenu', $data);
    }

    // 예약내역( 목록 )
    public function myReserveList(Request $request){
        //DB::enableQueryLog();
        $data = [];
        $data['reservLists'] = MobileReservSeat::
        select('mobile_reserv_seats.*',DB::raw('partners.*'),DB::raw('partner_reviews.rv_no as review_no'))
        ->where("mobile_reserv_seats.rv_member", Auth::guard('user')->user()->id)
        ->leftjoin('partner_reviews', 'partner_reviews.rv_order', '=', 'mobile_reserv_seats.rv_order')
        ->leftjoin('partners', 'partners.p_no', '=', 'mobile_reserv_seats.rv_partner')
        ->where(function ($query) use ($request) {

            if ($request->no) {
                $query->where("rv_partner", $request->no);
            }
            if ($request->q) {
                if( $request->fd == "cont" ) {
                    $query->where("rv_contents", "like", "%" . $request->q . "%");
                } elseif( $request->fd == "member" ) {
                    $query->where("rv_member", "like", "%" . $request->q . "%");
                }  else {
                    $query->where("rv_contents", "like", "%" . $request->q . "%")
                        ->orwhere("rv_member", "like", "%" . $request->q . "%");
                }
            }
            if( $request->b_id ) {
                $query->where("b_id", $request->b_id);
            }
            if( $request->state ) {
                $query->where("b_state", $request->state);
            }

        })
        ->orderBy("mobile_reserv_seats.rv_sdate","desc")->paginate(10);
        //dd(DB::getQueryLog());
        //dd($data['reservLists'],Auth::guard('user')->user()->id);
        foreach( $data["reservLists"] as $reserv ) {
            $reserv->sdate_text = Carbon::createFromFormat('Y-m-d H:i:s', $reserv->rv_sdate )->format("Y년 m월 n일 H시 i분");
            $reserv->edate_text = Carbon::createFromFormat('Y-m-d H:i:s', $reserv->rv_edate )->format("Y년 m월 n일 H시 i분");
        }

        return view('mobile.my_shop_history', $data);
    }

    public function myReserveQR(Request $request){

        if( $request->rv == "none" ) {
            $qr_data = Crypt::encryptString("none");
            return QrCode::size(400)->format('png')->backgroundColor(255,255,255)->generate($qr_data);
        }

        if( !$request->rv ) {
            return response(["result"=>false, "message"=>"예약코드가 선택되지 않았습니다."]);
        }

        $request->mode ?? $request->mode ?? "";

        $this->MobileReservSeat = MobileReservSeat::find($request->rv);

        if( $this->MobileReservSeat->rv_pass_last= "" || ($request->mode == "refresh" && $this->MobileReservSeat->rv_pass_last < now()->format("Y-m-d H:i:s") ) ) {
            $new_pass = mt_rand(1000, 9999);
            $this->MobileReservSeat->rv_pass = $new_pass;
            $this->MobileReservSeat->rv_pass_last = now()->addSeconds(30);
            $result["result"] = $this->MobileReservSeat->update();
        }

        $qr_data = Crypt::encryptString($this->MobileReservSeat->rv_pass);
        return QrCode::size(400)->format('png')->generate($qr_data);
    }




    /* 출입문 QR 인식코드 */
    public function myReserveQRCheck(Request $request){

        if( !$request->qr ) {
            return response(["result"=>false, "message"=>"코드가 존재하지 않습니다."]);
        }

        $user_passwd = Crypt::decryptString($request->qr);


        if( $user_passwd ) {

            $this->MobileReservSeat = MobileReservSeat::where("rv_pass",$user_passwd)->first();

            if( $this->MobileReservSeat ) {

                $pass_last_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->MobileReservSeat->rv_pass_last)->getTimeStamp();
                $now = now()->getTimeStamp();



                if( $pass_last_time > $now ) {
                    $data['result'] = true;

                    // 패스워드필드 초기화
                    //$this->MobileReservSeat->rv_pass = "";
                    //$this->MobileReservSeat->update();
                    $state = "IN";



                    $result = $this->ChangeSeatState($this->MobileReservSeat->rv_no, $state);
                    return response($result);

                } else {
                    $data['result'] = false;
                    $data['message'] = "패스워드 유효기간이 만료되었습니다.";
                    return response($data);
                }
            } else {
                $data['result'] = false;
                $data['message'] = "예약이 존재하지 않습니다.";
                return response($data);
            }
        } else {
            $data['result'] = false;
            $data['message'] = "패스워드를 입력해주세요.";
            return response($data);
        }



        return response(
            ["result"=>false, "message"=>$qr_data]
        );


    }

    /* 출입문 비번 변경*/
    public function ChangeDoorPasswd(Request $request){
        $result = [];
        $result["result"] = true;

        if( !$request->rv ) {
            return response(["result"=>false, "message"=>"예약코드가 선택되지 않았습니다."]);
        }

        $this->MobileReservSeat = MobileReservSeat::find($request->rv);

        if( $this->MobileReservSeat->rv_pass_last < now()->format("Y-m-d H:i:s") ) {
            $new_pass = mt_rand(1000, 9999);
            $this->MobileReservSeat->rv_pass = $new_pass;
            $this->MobileReservSeat->rv_pass_last = now()->addHours(3);
            $result["result"] = $this->MobileReservSeat->update();
        }

        $result["rv"] = $request->rv;
        $result["pass"] = $this->MobileReservSeat->rv_pass;

        return response($result);
    }

    /* 출입문 비번 입력 */
    public function passwd_push(Request $request){
        $data = [];

        if( $request->passwd ) {
            $this->MobileReservSeat = MobileReservSeat::where("rv_pass",$request->passwd)->first();

            if( $this->MobileReservSeat ) {
                $data['result'] = false;

                $pass_last = Carbon::createFromFormat('Y-m-d H:i:s', $this->MobileReservSeat->rv_pass_last);
                $now = now();


                if( $pass_last > $now ) {
                    $data['result'] = true;

                    // 패스워드필드 초기화
                    //$this->MobileReservSeat->rv_pass = "";
                    //$this->MobileReservSeat->update();
                    $request->rv = $this->MobileReservSeat->rv_no;
                    $request->st = "IN";

                    $result = $this->ChangeSeatState($request->rv, $request->st);
                    return response($result);

                } else {
                    $data['result'] = false;
                    $data['message'] = "패스워드 유효기간이 만료되었습니다.";
                    return response($data);
                }
            } else {
                $data['result'] = false;
                $data['message'] = "예약이 존재하지 않습니다.";
                return response($data);
            }
        } else {
            $data['result'] = false;
            $data['message'] = "패스워드를 입력해주세요.";
            return response($data);
        }
    }

    /* 입실여부 */
    public function myReserveChangeSeatState(Request $request){

        $result = [];
        $result["result"] = false;

        $result = $this->ChangeSeatState($request->rv, $request->st);
        return response($result);
    }

    /* 입실상태 */
    public function ChangeSeatState($rv, $st){

        $result = [];
        $result["result"] = false;

        if( !$rv ) {
            return ["result"=>false, "message"=>"예약코드가 선택되지 않았습니다."];
        }
        if( !$st ) {
            return ["result"=>false, "message"=>"상태가 선택되지 않았습니다."];
        }

        $this->MobileReservSeat = MobileReservSeat::find($rv);

        $this->partner = Partner::select("p_no","p_id")->where("p_no",  $this->MobileReservSeat->rv_partner)->first();
        Config::set('database.connections.partner.database',"boss_".$this->partner->p_id);

        $this->FrenchReservSeat = FrenchReservSeat::find($this->MobileReservSeat->rv_partner_rv);

        if( $this->FrenchReservSeat->rv_state_seat == "END" ) {
            $result["result"] = false;
            $result["rv"] = $this->FrenchReservSeat;
            $result["message"] = "종료된 예약은 변경이 불가능합니다.";
            return $result;
        }

        $this->FrenchReservSeat->rv_state_seat = $st;

        if( $st == "IN") {

            $this->FrenchReservSeat->rv_state_seat = "IN";
            $this->FrenchReservSeat->rv_state_seat_in = now()->format("Y-m-d H:i:s");
            if( $result["result"] = $this->FrenchReservSeat->update() ) {
                $this->MobileReservSeat->rv_state_seat = "IN";
                $this->MobileReservSeat->rv_state_seat_in = now()->format("Y-m-d H:i:s");
                $this->MobileReservSeat->update();

                // 문열기 실행
                $IOT = new IOT();
                $IOT->setPartner($this->partner->p_no);
                $IOT->seatIOT($this->FrenchReservSeat->rv_seat, "room_door", "O");
                $IOT->seatIOT($this->FrenchReservSeat->rv_seat, "light", "O");
            }
        }
        if( $st == "OUT") {
            $this->FrenchReservSeat->rv_state_seat = "OUT";
            $this->FrenchReservSeat->rv_state_seat_out = now()->format("Y-m-d H:i:s");
            if( $result["result"] = $this->FrenchReservSeat->update() ) {
                $this->MobileReservSeat->rv_state_seat = "IN";
                $this->MobileReservSeat->rv_state_seat_in = now()->format("Y-m-d H:i:s");
                $this->MobileReservSeat->update();
            }
        }

        $stime = Carbon::createFromFormat('Y-m-d H:i:s', $this->MobileReservSeat->rv_sdate )->getTimestamp();
        $etime = Carbon::createFromFormat('Y-m-d H:i:s', $this->MobileReservSeat->rv_edate )->getTimestamp();
        $ntime = Carbon::now()->timestamp;

        $result["rv"] =  $rv;
        $result["stime"] =  $this->MobileReservSeat->rv_sdate;
        $result["etime"] =  $this->MobileReservSeat->rv_edate;
        $result["total"] =  $etime - $stime;
        $result["last"] =  $etime - $ntime;
        $result["last"] =  0;
        $result["last_text"] = getLastTime($result["last"]);
        $result["used"] =  ceil($result["last"]/$result["total"]*100);

        $result["state"] = $this->MobileReservSeat->rv_state_seat;
        return $result;
    }

    /* 입실상태 */
    public function myReserveSeatState(Request $request){

        $result = [];
        $result["result"] = false;
        $result["state"] = "Z";


        if( !$request->rv ) {
            return response(["result"=>false, "message"=>"예약코드가 선택되지 않았습니다."]);
        }
        $this->MobileReservSeat = MobileReservSeat::find($request->rv);

        $result["rv"] = $this->MobileReservSeat;
        $this->partner = Partner::select("p_no","p_id")->where("p_no",  $this->MobileReservSeat->rv_partner)->first();

        Config::set('database.connections.partner.database',"boss_".$this->partner->p_id);

        $this->FrenchReservSeat = FrenchReservSeat::find($this->MobileReservSeat->rv_partner_rv);

        $stime = Carbon::createFromFormat('Y-m-d H:i:s', $this->FrenchReservSeat->rv_sdate )->getTimestamp();
        $etime = Carbon::createFromFormat('Y-m-d H:i:s', $this->FrenchReservSeat->rv_edate )->getTimestamp();
        $ntime = Carbon::now()->getTimestamp();

        $result["result"] = true;
        $result["time_start"] =  $this->FrenchReservSeat->rv_sdate;
        $result["time_now"] =  Carbon::now()->format("Y-m-d H:i:s");
        $result["time_end"] =  $this->FrenchReservSeat->rv_edate;
        $result["total"] =  $etime - $stime;
        $result["last"] =  $etime - $ntime;
        $result["last_text"] = getLastTime($result["last"]);
        $result["pass_last"] =  Carbon::createFromFormat('Y-m-d H:i:s', $this->MobileReservSeat->rv_pass_last )->getTimestamp();
        $result["used"] =  $ntime - $stime;
        $result["used_rate"] =  100 - ceil( ($result["last"] / $result["total"]) * 100 );

        // 종료전인데 시간이 지났다면
        if( $this->FrenchReservSeat->rv_state_seat != "END" ) {

            if( $result["last"] <= 0 ) {
                $this->FrenchReservSeat->rv_state_seat = "END";
                if( $this->FrenchReservSeat->update() ) {

                    // 모바일도 동시에 변경
                    $this->MobileReservSeat->rv_state_seat = "END";
                    $this->MobileReservSeat->update();

                }
            }

        }

        if( $this->FrenchReservSeat->rv_state_seat == "END" ) {

        } else if( $this->FrenchReservSeat->rv_state_seat == "IN" || $this->FrenchReservSeat->rv_state_seat == "OUT") {

        } else if( $this->FrenchReservSeat->rv_state_seat == "" ) {

            $result["ttt"] = $stime - $ntime;

            ## 아직 사용전이고 예약시간이 지났다면 버튼은 활성화
            if( $stime - $ntime <= 3600 ) {
                $result["possible"] = true;
            } else {
                $result["possible"] = false;
            }

        }

        $result["rv"] =  $this->MobileReservSeat->rv_no;
        $result["state"] = $this->MobileReservSeat->rv_state_seat;

        return response($result);
    }

    // 종료시키는 API
    public function Reserve2End(Request $request){
        //DB::enableQueryLog();
        $data = [];
        $n_dt = Carbon::now()->format("Y-m-d H:i:s");

        $data['reservLists'] = MobileReservSeat::
        where("mobile_reserv_seats.rv_state_seat", "!=", "END")
        ->where("rv_edate", "<", $n_dt)
        ->get();


        if( isset( $data["reservLists"]  ) ) {
            foreach( $data["reservLists"] as $RservSeat ) {
                $RservSeat->rv_state_seat = "END";
                $RservSeat->update();
            }
        }

    }

    // 예약내역( 이용권 )
    public function myReservePassList(Request $request){
        //DB::enableQueryLog();
        $data = [];

        if( Auth::guard('user')->check() ) {
            $data['reservLists'] = MobileReservSeat::
            select('mobile_reserv_seats.*',DB::raw('partners.*'),DB::raw('partner_reviews.rv_no as review_no'))
            ->where("mobile_reserv_seats.rv_member", Auth::guard('user')->user()->id)
            ->where("mobile_reserv_seats.rv_state_seat", "!=", "END")
            ->leftjoin('partner_reviews', 'partner_reviews.rv_order', '=', 'mobile_reserv_seats.rv_order')
            ->leftjoin('partners', 'partners.p_no', '=', 'mobile_reserv_seats.rv_partner')
            ->where(function ($query) use ($request) {
                if ($request->no) {
                    $query->where("rv_partner", $request->no);
                }
                if ($request->q) {
                    if( $request->fd == "cont" ) {
                        $query->where("rv_contents", "like", "%" . $request->q . "%");
                    } elseif( $request->fd == "member" ) {
                        $query->where("rv_member", "like", "%" . $request->q . "%");
                    }  else {
                        $query->where("rv_contents", "like", "%" . $request->q . "%")
                            ->orwhere("rv_member", "like", "%" . $request->q . "%");
                    }
                }
                if( $request->b_id ) {
                    $query->where("b_id", $request->b_id);
                }
                if( $request->state ) {
                    $query->where("b_state", $request->state);
                }

            })
            ->orderBy("mobile_reserv_seats.rv_sdate","desc")->paginate(10);
            //dd(DB::getQueryLog());
            //dd($data['reservLists'],Auth::guard('user')->user()->id);


            if( isset( $data["reservLists"]  ) ) {
                foreach( $data["reservLists"] as $reserv ) {

                    $reserv->qrcode = QrCode::size(400)->generate($reserv->rv_no);
                    $reserv->sdate_text = Carbon::createFromFormat('Y-m-d H:i:s', $reserv->rv_sdate )->format("Y년 m월 n일 H시 i분");
                    $reserv->edate_text = Carbon::createFromFormat('Y-m-d H:i:s', $reserv->rv_edate )->format("Y년 m월 n일 H시 i분");
                }
            }
        }

        return view('mobile.voucher_qr_all', $data);
    }

    public function myProductDetail(Request $request){

        $data = [];
        if( $request->rv ){

            #예약번호만 있으면 예약번호로 주문정보도 가져옴
            $data["reserv"] = $this->MobileReservSeat::where("rv_no", $request->rv)
            ->orderby("rv_no","desc")
            ->first();

            $data["order"] = $this->MobileProductOrder->where("o_no", $data["reserv"]->rv_order)->first();

        } else if( $request->order ) {

            #주문정보 있음
            $data["order"] = $this->MobileProductOrder->find($request->order);

            # 최종예약내역
            if( $request->rv ) {

                $data["reserv"] = $this->MobileReservSeat::where("rv_order", $request->order)
                ->where("rv_no", $request->rv)
                ->orderby("rv_no","desc")
                ->first();

            } else {

                $data["reserv"] = $this->MobileReservSeat::where("rv_order", $request->order)
                ->orderby("rv_no","desc")
                ->first();
            }

        }

        if( $data["order"]->o_product_kind ) {
            $data["order"]->o_product_name = config("product.productType.".$data["order"]->o_product_kind);
        }

        ## 남은시간
        $data["order"]->o_remainder_text = "";
        if( $data["order"]->o_remainder_day > 0 ) {
            $data["order"]->o_remainder_text .= $data["order"]->o_remainder_day . " 일";
        }
        if( $data["order"]->o_remainder_time > 0 ) {
            $data["order"]->o_remainder_text .= $data["order"]->o_remainder_time . " 시간";
        }
        if( $data["order"]->o_remainder_point > 0 ) {
            $data["order"]->o_remainder_text .= number_format($data["order"]->o_remainder_point) . " 포인트";
        }

        $data["partner"] = Partner::select("p_no","p_id","p_name","p_phone")->where("p_no",  $data["order"]->o_partner)->first();

        if( $data["reserv"] ) {
            ## 해당회원의 예약정보인지 확인
            if( $data["reserv"]->rv_member != Auth::guard('user')->user()->id ) {
                $data["result"] = false;
                $data["message"] = "회윈님의 예약정보가 아닙니다.";
                return redirect('my_home');
            }

            $r_sdt = Carbon::createFromFormat('Y-m-d H:i:s', $data["reserv"]->rv_sdate );
            $r_edt = Carbon::createFromFormat('Y-m-d H:i:s', $data["reserv"]->rv_edate );
            $n_dt = Carbon::now();

            // 개발을 위해 무조건..
            if( $data["reserv"]->rv_state_seat ) {
                if(  $n_dt < $r_edt ) {  // 시간제한을 두면 좋을것 같음.
                    $data["enable_change_time"] = true;
                    $data["enable_change_seat"] = true;
                    $data["is_end"] = false;
                } else {
                    $data["enable_change_time"] = false;
                    $data["enable_change_seat"] = false;
                    $data["is_end"] = true;
                }
            } else {
                $data["enable_change_time"] = false;
                $data["enable_change_seat"] = false;
                $data["is_end"] = false;
            }

            ## 상품종류에 따른 날자 표기
            if( $data["order"]->o_product_kind == "A") {
                $data["reserv"]->rv_sdate_text = $r_sdt->format("Y.m.d H:i")." (".getNum2Week($r_sdt->format("w")).")" ." ~ ". $r_edt->format("Y.m.d H:i")." (".getNum2Week($r_edt->format("w")).")";
            } if( $data["order"]->o_product_kind == "D") {
                $data["reserv"]->rv_sdate_text = $r_sdt->format("Y.m.d H:i")." (".getNum2Week($r_sdt->format("w")).")" ." ~ ". $r_edt->format("Y.m.d H:i")." (".getNum2Week($r_edt->format("w")).")";
            } elseif( $data["order"]->o_product_kind == "F") {
                $data["reserv"]->rv_sdate_text = $r_sdt->format("Y.m.d")." (".getNum2Week($r_sdt->format("w")).")" ." ~ ". $r_edt->format("Y.m.d")." (".getNum2Week($r_edt->format("w")).")";
            } elseif( $data["order"]->o_product_kind == "T") {
                $data["reserv"]->rv_sdate_text = $r_sdt->format("Y.m.d")." (".getNum2Week($r_sdt->format("w")).")" . $r_sdt->format("H:i") . " ~ ". $r_edt->format("Y.m.d")." (".getNum2Week($r_edt->format("w")).")" . $r_edt->format("H:i");
            }

            Config::set('database.connections.partner.database',"boss_".$data["partner"]->p_id);

            // 선택된 좌석정보
            $this->FrenchRoom = FrenchRoom::where("r_no",$data["reserv"]->rv_room)->first();
            $this->FrenchSeat = FrenchSeat::where("s_no",$data["reserv"]->rv_seat)->first();

            if( $data["reserv"]->rv_seat ) {
                $data["reserv"]->rv_seat_text = $this->FrenchRoom->r_name .  ( $this->FrenchSeat->s_name ? $this->FrenchSeat->s_name : $this->FrenchSeat->s_no );
            }


        } else {

        }


        //$data["reserv"]['is_Cancel'] = "Y";


        return view('mobile.my_shop_history_detail1', $data);
    }

    // 예약이 가능한 시간인지 확인
    function isEnableReserveTime($partner_id, $sdate, $stime, $edate, $etime, $seat=null ){

        // 해당 시간에 예약이 있는지 확인
        $r_sdt = Carbon::createFromFormat('Y-m-d H:i', $sdate . " " . $stime);
        $r_edt = Carbon::createFromFormat('Y-m-d H:i', $edate . " " . $etime);

        // 같은 시간 중복여부
        Config::set('database.connections.partner.database', "boss_" . $partner_id);
        $result = \App\Models\FrenchReservSeat::
        where(function ($query) use ($seat, $sdate, $stime, $edate, $etime) {
            if( $seat ) {
                $query->where("rv_seat","!=",$seat);
            }
            if( $sdate ) {
                $query->where([
                    ['rv_sdate', '>=', $sdate . " " . $stime],
                    ['rv_sdate', '<=', $edate . " " . $etime],
                ])
                ->orwhere([
                    ['rv_edate', '>=', $sdate . " " . $stime],
                    ['rv_edate', '<=', $edate . " " . $etime],
                ]);
            }
        })->first();

        return $result;
    }


    // 퇴실
    public function reserveSeatOut(Request $request){

        $data = [];
        $data["result"] = false;


        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {
            $data['result'] = false;
            $data['message'] = "예약정보가 존재하지 않습니다.";
            return response($data);
        }

        if( $this->MobileReservSeat->rv_state_seat == "END" ) {
            $data['result'] = false;
            $data['message'] = "종료된 예약정보입니다.";
            return response($data);
        }

        if( $this->MobileReservSeat->rv_state_seat != "" && now()->format("Y-m-d H:i:s") > $this->MobileReservSeat->rv_edate ) {
            $data['result'] = false;
            $data['message'] = "종료된 예약정보입니다.";
            return response($data);
        }

        $s_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->FrenchReservSeat->rv_sdate)->getTimeStamp();
        $n_time = now()->getTimeStamp();

        $data["result"] = true;
        ## 현재상태를 종료시킴
        $this->FrenchReservSeat->rv_state_seat = "END";
        $this->FrenchReservSeat->rv_used_time = $n_time - $s_time;
        if( $this->FrenchReservSeat->rv_duration_type == "T" ) {
            $this->FrenchReservSeat->rv_duration_time = $this->FrenchReservSeat->rv_duration * 3600;
        } elseif( $this->FrenchReservSeat->rv_duration_type == "D" ) {
            $this->FrenchReservSeat->rv_duration_time = $this->FrenchReservSeat->rv_duration * 86400;
        } elseif( $this->FrenchReservSeat->rv_duration_type == "M" ) {
            $this->FrenchReservSeat->rv_duration_time = $this->FrenchReservSeat->rv_duration * 86400;
        }

        $this->MobileReservSeat->rv_duration_time = $this->FrenchReservSeat->rv_duration_time;
        $this->MobileReservSeat->rv_state_seat = $this->FrenchReservSeat->rv_state_seat;
        $this->MobileReservSeat->rv_used_time = $this->FrenchReservSeat->rv_used_time;

        if( $this->FrenchReservSeat->update() ) {
            $this->MobileReservSeat->update();
            return response($data);
        } else {
            $data['result'] = false;
            $data['message'] = "변경에 실패했습니다.<br>";
            return response($data);
        }
    }


    // 예약 시간변경실행
    public function reserveChangeTime(Request $request){

        $data = [];
        $data["result"] = false;
        $this->MobileReservSeat = MobileReservSeat::find($request->rv);

        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {

        }

        // 변경할 시간의 예약확인
        Config::set('database.connections.partner.database',"boss_".$this->partner->p_id);


        // 해당 시간에 예약이 있는지 확인
        $r_sdt = Carbon::createFromFormat('Y-m-d H:i', $request->b_sdate . " " . $request->b_stime);
        $r_edt = Carbon::createFromFormat('Y-m-d H:i', $request->b_edate . " " . $request->b_etime);


        if( $this->FrenchReservSeat->rv_seat == $request->b_seat ) {
            $data['result'] = false;
            $data['message'] = "좌석 정보가 일치하지 않습니다.".$this->FrenchReservSeat->rv_seat.$request->b_seat;
            return response($data);
        }

        $dupReserveInfo = $this->isEnableReserveTime($this->partner->p_id, $request->b_sdate, $request->b_stime, $request->b_edate, $request->b_etime, $request->b_seat );

        if ( $dupReserveInfo && $this->FrenchReservSeat->rv_no == $dupReserveInfo->rv_seat ) {
            $data['result'] = false;
            $data['message'] = "이미 사용 및 예약내역이 있습니다.<br>" . $dupReserveInfo->b_sdate . "~" . $dupReserveInfo->b_edate;
            return response($data);
        }

        // 시간변경실행
        if( $this->MobileReservSeat->rv_sdate > now()->format("Y-m-d H:i:s") ) {
            $this->FrenchReservSeat->rv_sdate = $request->b_sdate . " " . $request->b_stime;
            $this->FrenchReservSeat->rv_edate = $request->b_edate . " " . $request->b_etime;

            if( $this->FrenchReservSeat->update() ) {
                $this->MobileReservSeat->rv_sdate = $this->FrenchReservSeat->rv_sdate;
                $this->MobileReservSeat->rv_edate = $this->FrenchReservSeat->rv_edate;
                $data['result'] = $this->MobileReservSeat->update();
                return response($data);
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }

        } else {
            $data['result'] = false;
            $data['message'] = "이미 예약시간이 지났습니다. 환불후 다시 예약 해주세요.<br>";
            return response($data);
        }

    }

    // 예약 시간변경
    public function reserveChangeTimeForm(Request $request){

        $data = [];
        $data["result"] = false;

        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {
            // 예약이 존재하지 않음...
        }


        // 이동실행
        if( $this->MobileReservSeat->rv_sdate > now()->format("Y-m-d H:i:s") ) {
            $this->FrenchReservSeat->rv_sdate = $request->b_sdate . " " . $request->b_stime;
            $this->FrenchReservSeat->rv_edate = $request->b_edate . " " . $request->b_etime;

            if( $this->FrenchReservSeat->update() ) {
                $this->MobileReservSeat->rv_sdate = $this->FrenchReservSeat->rv_sdate;
                $this->MobileReservSeat->rv_edate = $this->FrenchReservSeat->rv_edate;
                $data['result'] = $this->MobileReservSeat->update();
                return response($data);
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }

        } else {
            $data['result'] = false;
            $data['message'] = "이미 예약시간이 지났습니다. 환불후 다시 예약 해주세요.<br>";
            return response($data);
        }

        return view('mobile.voucher_calendar', $data);
    }

    public function reserveChangeSeat(Request $request){

        $data = [];
        $data["result"] = false;

        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {
            $data['result'] = false;
            $data['message'] = "예약정보가 존재하지 않습니다.<br>";
            return response($data);
        }

        if( now()->format("Y-m-d H:i:s") > $this->MobileReservSeat->rv_edate ) {
            $data['result'] = false;
            $data['message'] = "종료된 예약정보입니다.<br>";
            return response($data);
        }

        // 좌석변경
        if( $this->MobileReservSeat->rv_sdate > now()->format("Y-m-d H:i:s") ) {
            $this->FrenchReservSeat->rv_seat = $request->b_seat;

            if( $this->FrenchReservSeat->update() ) {
                $this->MobileReservSeat->rv_seat = $this->FrenchReservSeat->rv_seat;
                $data['result'] = $this->MobileReservSeat->update();
                return response($data);
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }

        } else {

            $n_dt = now()->format("Y-m-d H:i:s");

            ## 원본을 복사해둠.
            $new_FrenchReservSeat = $this->FrenchReservSeat->replicate();
            $new_MobileReservSeat = $this->MobileReservSeat->replicate();

            ## 현재상태를 종료시킴
            $this->FrenchReservSeat->rv_state_seat = "END";
            $this->FrenchReservSeat->rv_edate = $n_dt;
            if( $this->FrenchReservSeat->update() ) {
                $this->MobileReservSeat->rv_state_seat = "END";
                $this->MobileReservSeat->rv_edate = $n_dt;
                $this->MobileReservSeat->update();

                ## 복사해둔 정보를 신규예약정보로 저장
                $new_FrenchReservSeat->rv_seat = $request->b_seat;
                $new_FrenchReservSeat->rv_state_seat = "";
                $new_FrenchReservSeat->rv_sdate = $n_dt;
                if( $new_FrenchReservSeat->save() ) {

                    $new_MobileReservSeat->rv_seat = $request->b_seat;
                    $new_MobileReservSeat->rv_state_seat = "";
                    $new_MobileReservSeat->rv_partner_rv = $new_FrenchReservSeat->rv_no;
                    $new_MobileReservSeat->rv_sdate = $n_dt;
                    $data['result'] = $new_MobileReservSeat->save();
                    $data['rv'] = $new_FrenchReservSeat->rv_no;
                }

                return response($data);
            } else {
                $data['result'] = false;
                $data['message'] = "변경에 실패했습니다.<br>";
                return response($data);
            }


            $this->FrenchReservSeat->rv_seat = $request->b_seat;


            $data['result'] = false;
            $data['message'] = "이미 예약시간이 지났습니다. 환불후 다시 예약 해주세요.<br>";
            return response($data);
        }


        return view('mobile.voucher_seat_select', $data);
    }

    // 예약 좌석변경
    public function reserveChangeSeatForm(Request $request){

        $data = [];
        $data["result"] = false;

        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {
            // 예약이 존재하지 않음...
        }

        list($data["b_sdate"],$data["b_stime"]) = explode(" ", $this->FrenchReservSeat->rv_sdate );

        $data["o"] = $request->o ?? null;
        $data["partner"] = $this->partner;
        $data["b_rv"] = $this->MobileReservSeat->rv_no;
        $data["b_duration"] = $this->FrenchReservSeat->rv_duration;
        list($data["b_sdate"],$data["b_stime"]) = explode(" ",substr($this->FrenchReservSeat->rv_sdate,0,16));
        list($data["b_edate"],$data["b_etime"]) = explode(" ",substr($this->FrenchReservSeat->rv_edate,0,16));
        $data["b_seat"] = $this->FrenchReservSeat->rv_seat;

        return view('mobile.voucher_seat_select', $data);
    }


    public function reserveRefundPriceArr(){

        $data = [];

        ## 전체금액
        $total_used_time = MobileReservSeat::where("rv_order", $this->MobileReservSeat->rv_order)->sum('rv_used_time');

        // 기간단위로 자름..
        if( $this->MobileProductOrder->o_duration_type == "T" ) {
            $total_used_duration = ceil($total_used_time / 3600);
        } if( $this->MobileProductOrder->o_duration_type == "T" ) {
            $total_used_duration = ceil($total_used_time / 3600);
        } elseif( $this->MobileProductOrder->o_duration_type == "D" ) {
            $total_used_duration = ceil($total_used_time / 86400);
        } elseif( $this->MobileProductOrder->o_duration_type == "M" ) {
            $total_used_duration = ceil($total_used_time / 86400 );
        } else {
            $total_used_duration = 0;
        }

        # 같은 조건의 사용시간에 대한 비용 확인......
        Config::set('database.connections.partner.database', "boss_" . $this->partner->p_id);

        // 선택된 좌석정보
        $this->FrenchSeat = FrenchSeat::where("s_no", $this->FrenchReservSeat->rv_seat)->first();

        // 선택된 좌석레벨정보
        $this->FrenchSeatLevel = FrenchSeatLevel::where("sl_no", $this->FrenchSeat->s_level)->first();

        if ( $this->FrenchReservSeat->rv_product_kind == "A" || $this->MobileProductOrder->o_product_kind == "P" || $this->MobileProductOrder->o_product_kind == "T" ) {
            $price_data = json_decode($this->FrenchSeatLevel->sl_price_time, true);
        } else {
            $price_data = json_decode($this->FrenchSeatLevel->sl_price_day, true);
        }

        if($total_used_duration == 0 ){
            ## 기간단위가 없다면 환불불가능 관리자에게 문의해주세요.
            if( isset($price_data) && isset($price_data[$total_used_duration]) && $price_data[$total_used_duration] ) {
                $price_info = $price_data[$total_used_duration][$this->MobileProductOrder->o_ageType][$this->MobileProductOrder->o_priceType];
            } else {
                $price_info = [
                        "S" => 0,
                        "R" => 0,
                        "T" => 0
                ];
            }

        } else {
            $price_info = [
                "S" => 0,
                "R" => 0,
                "T" => 0
        ];
        }

        ## 사용시간에 대한 금액
        //$price_info['T']; // T:토탈 S:스터디룸 R:독서실

        ## 환불할 금액 : 결제금액 - 사용금액
        if( $price_info['T'] ) {

        }
        $refund_pirce = $this->MobileProductOrder->o_price_total - $price_info['T'];

        $data["total_price"] = $this->MobileProductOrder->o_price_total;
        $data["used_price"] = (int)$price_info['T'];
        $data["refund_pirce"] = $refund_pirce;

        return $data;
    }

    // 예약 환불 실행
    public function reserveRefundOrder(Request $request){

        $data = [];
        $data["result"] = true;

        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {
            // 예약이 존재하지 않음...
        }

        $this->MobileProductOrder = MobileProductOrder::find($this->MobileReservSeat->rv_order);

        ## 환불요청으로 업데이트
        Config::set('database.connections.partner.database', "boss_" . $this->partner->p_id);
        $this->FrenchProductOrder = FrenchProductOrder::find($this->MobileProductOrder->o_partner_order);


        ## 해당 모든 예약이 종료되었는지 확인
        $myReserveAll = MobileReservSeat::where("rv_order", $this->MobileReservSeat->rv_order)->where("rv_state_seat","!=","END")->first();
        if($myReserveAll) {
            $data['result'] = false;
            $data['message'] = "모든 예약을 취소(퇴실)하신 후에 환불이 가능합니다.<br>";
            return response($data);
        }

        $PriceArr = $this->reserveRefundPriceArr();

        $data["result"] = true;
        $data["rv"] = $request->rv;

        ## 환불요청으로 업데이트
        $this->FrenchProductOrder->o_refund = "A";
        $this->FrenchProductOrder->o_refund_at = now()->format("Y-m-d H:i:s");
        $this->FrenchProductOrder->o_refund_price = $PriceArr['refund_pirce'];
        $this->FrenchProductOrder->o_refund_memo = $request->memo;
        if( $this->FrenchProductOrder->update() ) {

            $this->MobileProductOrder->o_refund = $this->FrenchProductOrder->o_refund;
            $this->MobileProductOrder->o_refund_memo = $this->FrenchProductOrder->o_refund_memo;
            $this->MobileProductOrder->o_refund_at = $this->FrenchProductOrder->o_refund_at;
            $this->MobileProductOrder->o_refund_price = $this->FrenchProductOrder->o_refund_price;
            $this->MobileProductOrder->update();
        }

        $data["r"] = $this->FrenchProductOrder->update();
        return response($data);
    }


    // 예약 환불
    public function reserveRefundForm(Request $request){

        $data = [];

        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {
            // 예약이 존재하지 않음...
        }

        $this->MobileProductOrder = MobileProductOrder::find($this->MobileReservSeat->rv_order);


        ## 이미 환불요청이라면...
        if($this->MobileProductOrder->o_refund == "A")  {
            return redirect()->back()->with("alert","이미 환불신청상태입니다.");
        }



        ## 해당 모든 예약이 종료되었는지 확인
        $myReserveAll = MobileReservSeat::where("rv_order", $this->MobileReservSeat->rv_order)->where("rv_state_seat","!=","END")->first();
        if($myReserveAll) {
            return redirect()->back()->with("alert","모든 예약을 취소(퇴실)하신 후에 환불이 가능합니다.");
        }

        if( $this->MobileProductOrder->o_product_kind ) {
            $this->MobileProductOrder->o_product_name = config("product.productType.".$this->MobileProductOrder->o_product_kind);
        }

        $PriceArr = $this->reserveRefundPriceArr();

        $data = $PriceArr;
        $data["rv"] = $request->rv;
        $data["partner"] = $this->partner;
        $data['order'] = $this->MobileProductOrder;

        return view('mobile.voucher_refund', $data);

        ## 환불요청으로 업데이트
        // $this->FrenchReservSeat->o_refund = "A";
        // $this->FrenchReservSeat->o_refund_at = now()->format("Y-m-d H:i:s");
        // $this->FrenchReservSeat->o_refund_price = $refund_pirce;
        // if( $this->FrenchReservSeat->update() ) {
        //     $this->FrenchReservSeat->o_refund = $this->FrenchReservSeat->o_refund;
        //     $this->FrenchReservSeat->o_refund_at = $this->FrenchReservSeat->o_refund_at;
        //     $this->FrenchReservSeat->o_refund_price = $this->FrenchReservSeat->o_refund_price;
        //     $this->MobileReservSeat->update();
        // }

    }

    // 예약 환불 완료
    public function reserveRefundFinal(Request $request){

        $data = [];

        if( $request->rv ) {
            $this->getAll_fromRV( $request->rv );
        } else {
            // 예약이 존재하지 않음...
        }

        $this->MobileProductOrder = MobileProductOrder::find($this->MobileReservSeat->rv_order);

        if( $this->MobileProductOrder->o_product_kind ) {
            $this->MobileProductOrder->o_product_name = config("product.productType.".$this->MobileProductOrder->o_product_kind);
        }

        ## 해당 예약이 환불신청중인지 확인
        if($this->MobileProductOrder->o_refund == "N") {
            $data['result'] = false;
            $data['message'] = "해당항목은 환불요청 건이 아닙니다.";
            return response($data);
        }

        $data["rv"] = $request->rv;
        $data["partner"] = $this->partner;
        $data['order'] = $this->MobileProductOrder;

        return view('mobile.voucher_refund_fin', $data);
    }




    ## 모바일 예약번호로 전부 로딩
    protected function getAll_fromRV( $rv ) {

        if( !$rv ) {
            return response(["result"=>false, "message"=>"예약코드가 선택되지 않았습니다."]);
        }
        $this->MobileReservSeat = MobileReservSeat::find($rv);
        $this->partner = Partner::where("p_no",  $this->MobileReservSeat->rv_partner)->first();

        if( $this->partner && $this->MobileReservSeat->rv_partner_rv) {
            Config::set('database.connections.partner.database',"boss_".$this->partner->p_id);
            $this->FrenchReservSeat = FrenchReservSeat::find($this->MobileReservSeat->rv_partner_rv);
        }
    }

}
