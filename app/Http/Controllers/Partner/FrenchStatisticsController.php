<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use Carbon\Carbon;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Models\FrenchSeat;
use App\Models\FrenchIot;
use App\Http\Classes\Iot;
class FrenchStatisticsController extends Controller
{
    public function __construct()
    {
        $this->FrenchProductOrder = new FrenchProductOrder();
        $this->FrenchReservSeat = new FrenchReservSeat();     
    }

    public function dayEndPartner(request $request )
    {

        $data = [];
        $exec_date = now();
        $partner = \App\Models\Partner::select("p_no","p_id","p_name","p_deadline_time","p_deadline_exec","p_commission")
        ->where("p_no", $request->partner_no )
        ->first();   


                // 업무마감시간
                $deadline_time = $partner->p_deadline_time;
                $commission = $partner->p_commission;
                $data["reserves"] = [];
                $deadline = [];


                $calc_sum_revenue = 0;
                $calc_sum_commission = 0; 
                $calc_reserve_count = 0;   
                $revenue = [];             

                ## 오후 6시 이후면 금일마감으로 
                if( $deadline_time >= "18:00:00" ) {
                    $calculateDate = now()->format("Y-m-d");
                } elseif( $deadline_time <= "06:00:00" ) { 
                    $calculateDate = now()->addDay(-1)->format("Y-m-d");
                } else {
                    
                }

                //$deadline['sdate'] = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s',  now()->addDay(-1)->format("Y-m-d " . $deadline_time));
                //$deadline['sdate'] = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s',  now()->addDay(-5)->format("Y-m-d " . $deadline_time));
                //$deadline['edate'] = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s',  now()->format("Y-m-d " . $deadline_time));

                ## 
                Config::set('database.connections.partner.database',"boss_".$partner->p_id);
                //Config::set('database.connections.partner.database',"boss_test01");
                $FrenchReservSeat = new \App\Models\FrenchReservSeat;
                $FrenchReservSeat->setConnection("partner");


                $data["reserves"] = $FrenchReservSeat::leftJoin("french_product_orders", "french_product_orders.o_no", "french_reserv_seats.rv_order")
                ->where(function ($query) use ($deadline) {
                        if( isset($deadline['sdate']) ) {
                            $query->where('rv_sdate', '>', $deadline['sdate']);
                            $query->where('rv_sdate', '<=', $deadline['edate']);
                        }

                            //$query->whereIn("rv_product_kind",['A','D','T','F','P']);
                            //->whereIn("rv_product_kind",['A'])
                            // ->orwhere([
                            //     ['rv_edate', '>=', now()->addDay(-1)->format("Y-m-d " . $deadline_time),
                            //     ['rv_edate', '<=', now()->addDay(-1)->format("Y-m-d " . $deadline_time),
                            // ]);
                })
                //->where("rv_state_seat","END")
                ->where("rv_calc","N")
                ->get();

                echo $partner->p_id.":::".count($data["reserves"])."건<br>";

                foreach( $data["reserves"] as $r => $reserve ) {

                            // end 로 변경 ( 고정권을 제외한 나머지 ?? 문제는 24시간운영 )
                            $revenue[$r]['product_kind'] = $reserve->rv_product_kind;
               
                            // 모바일예약인지 확인
                            if( $reserve->rv_product_kind == "F" ) {

                                // if( $reserve->o_price_seat > 0 ) {
                                //     if( $reserve->o_member_from == "M" ) {
                                //         $revenue[$r]['total']  = $reserve->o_price_seat;
                                //         // 하루금액
                                //         $revenue[$r]['dayPrice'] = $reserve->o_price_seat/$reserve->o_duration;

                                //         $revenue[$r]['commission'] = $revenue[$r]['dayPrice'] * $commission / 100;
                                //         $revenue[$r]['revenue'] = $revenue[$r]['dayPrice'] - $revenue[$r]['commission'];
                                //     } else {
                                //         $revenue[$r]['commission'] = 0;
                                //         $revenue[$r]['revenue'] = $reserve->o_price_seat;
                                //     }
                                // }
                                continue;
                                
                            } elseif( $reserve->rv_product_kind == "P" ) {
                                if( $reserve->o_price_seat > 0 ) {
                                    if( $reserve->o_member_from == "M" ) {
                                        $revenue[$r]['commission'] = $reserve->o_price_seat*$commission / 100;
                                        $revenue[$r]['revenue'] = $reserve->o_price_seat - $revenue[$r]['commission'];
                                    } else {
                                        $revenue[$r]['commission'] = 0;
                                        $revenue[$r]['revenue'] = $reserve->o_price_seat;
                                    }
                                }

                                // 금일 정산으로 END 로 변경.
                                $reserve->rv_calc = 'Y';
                                $reserve->rv_state_seat = 'END';
                                $reserve->rv_calc_dt = $exec_date;

                            } else if( $reserve->rv_product_kind == "D" ) {

                                if( $reserve->o_price_seat > 0 ) {
                                    if( $reserve->o_member_from == "M" ) {
                                        $revenue[$r]['total']  = $reserve->o_price_seat;
                                        // 하루금액
                                        $revenue[$r]['dayPrice'] = $reserve->o_price_seat/$reserve->o_duration;

                                        $revenue[$r]['commission'] = $revenue[$r]['dayPrice'] * $commission / 100;
                                        $revenue[$r]['revenue'] = $revenue[$r]['dayPrice'] - $revenue[$r]['commission'];
                                    } else {
                                        $revenue[$r]['commission'] = 0;
                                        $revenue[$r]['revenue'] = $reserve->o_price_seat;
                                    }
                                }

                                // 금일 정산으로 END 로 변경.
                                $reserve->rv_calc = 'Y';
                                $reserve->rv_state_seat = 'END';
                                $reserve->rv_calc_dt = $exec_date;

                            } else  {
                                if( $reserve->o_price_seat > 0 ) {
                                    if( $reserve->o_member_from == "M" ) {
                                        $revenue[$r]['commission'] = $reserve->o_price_seat*$commission / 100;
                                        $revenue[$r]['revenue'] = $reserve->o_price_seat - $revenue[$r]['commission'];
                                    } else {
                                        $revenue[$r]['commission'] = 0;
                                        $revenue[$r]['revenue'] = $reserve->o_price_seat;
                                    }
                                }

                                // 금일 정산으로 END 로 변경.
                                $reserve->rv_calc = 'Y';
                                $reserve->rv_state_seat = 'END';
                                $reserve->rv_calc_dt = $exec_date;                                
                            }

                            $calc_sum_revenue += $revenue[$r]['revenue'] ?? 0;;
                            $calc_sum_commission += $revenue[$r]['commission'] ?? 0;
                            $calc_reserve_count++;

                            $reserve->rv_revenue = $revenue[$r]['revenue'] ?? 0;
                            $reserve->rv_commission = $revenue[$r]['commission'] ?? 0;
                            $reserve->save();

                }

                $partnerCalculate = \App\Models\PartnerCalculate::where('cal_partner', $partner->p_no)
                ->where("cal_date",$calculateDate)->first();

                if( $partnerCalculate ) {
                    $partnerCalculate->cal_date = $calculateDate;
                    $partnerCalculate->cal_reserve_count = $calc_reserve_count;
                    $partnerCalculate->cal_revenue = $calc_sum_revenue ?? 0;;
                    $partnerCalculate->cal_commission = $calc_sum_commission ?? 0;
                    $partnerCalculate->update();
                } else {
                    $partnerCalculate = new \App\Models\PartnerCalculate;
                    $partnerCalculate->cal_partner = $partner->p_no;
                    $partnerCalculate->cal_date = $calculateDate;
                    $partnerCalculate->cal_reserve_count = $calc_reserve_count;
                    $partnerCalculate->cal_revenue = $calc_sum_revenue ?? 0;;
                    $partnerCalculate->cal_commission = $calc_sum_commission ?? 0;
                    $partnerCalculate->cal_status = "A";
                    $partnerCalculate->save();
                }

                $partner->p_deadline_exec = $exec_date->format("Y-m-d");
                $partner->update();

                # 모든 IOT OFF
                $IOT = new IOT();
                $IOT->setPartner($partner->p_no);

                # 2. 출입문등 선택적으로 
                $data["iots"] = \App\Models\FrenchIot::where("i_endwork","Y")->orderBy("i_no","asc")->get();

                foreach( $data["iots"] as $iot ) {
                    if( $iot->i_iot1 && $iot->i_iot2 ) {
                        $topic = $IOT->FrenchConfig->cf_iot_base . '/' . $iot->i_iot1;
                        $status = "F";
                        $output = $IOT->PublishGo($iot->i_iot1, $iot->i_iot2, $status);
                        echo $iot->i_no .":". $IOT->FrenchConfig->cf_iot_base  . ":" . $iot->i_iot1 . ":" . $iot->i_iot2 . ":" . $status."<br/>";
                    }
                    //var_dump($output);
                }                

                # 1. 모든 좌석
                $data["seats"] = \App\Models\FrenchSeat::select(["s_no", "s_iot1", "s_iot2"])->orderBy("s_no","desc")->get();

                foreach( $data["seats"] as $seat ) {
                    if( $seat->s_iot1 && $seat->s_iot2 ) {
                        $topic = $IOT->FrenchConfig->cf_iot_base . '/' . $seat->s_iot1;
                        $status = "F";
                        //$output = $IOT->PublishGo($seat->s_iot1, $seat->s_iot2, $status);
                        echo $seat->s_no .":". $IOT->FrenchConfig->cf_iot_base  . ":" . $seat->s_iot1 . ":" . $seat->s_iot2 . ":" . $status."<br/>";
                    }
                    //var_dump($output);
                }


            //var_dump($revenue);

    }
        
    public function dayEnd(Request $request)
    {
        $data = [];
        $exec_date = now();
        $partners = \App\Models\Partner::select("p_no","p_id","p_name","p_deadline_time","p_deadline_exec","p_commission")
        ->where("p_deadline_exec","<>", $exec_date->format("Y-m-d") )
        ->where("p_deadline_time",">", $exec_date->format("H:i:s") )
        ->where(function ($query) use ($request) {
            if( $request->partner ) {
                $query->where("p_no", $request->partner );
            }

        })
        ->get();   

        foreach( $partners as $partner ) {

            // $post = [
            //     'partner_no' => $partner->p_no,
            // ];

            //$headers[] = 'X-IB-Client-Id: 발급받은ID';
            $headers[] = '';
    
            $ch = curl_init("https://admin.eodilo.com/dayEndPartner?partner_no=".$partner->p_no);
    
            // SSL important
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);        
            //curl_setopt($ch, CURLOPT_POST, 1);                              //post
            //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));       //파라미터 값
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                    //return 값 반환 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                 //헤더
            //curl_setopt($ch, CURLOPT_VERBOSE, true);                        //디버깅
            //curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);               //데이터 전달 형태
            //curl_setopt($ch, CURLOPT_COOKIE, 'token= ***** ');            //로그인 인증
     
            $output = curl_exec($ch);
            echo $output;

        }


    }

    public function sales_day(Request $request)
    {
        //DB::enableQueryLog();	//query log 시작 선언부
        $data["statistic"] = [];
        $data["sales"] = $this->FrenchProductOrder
            ->select("french_product_orders.*")
            ->select([
                DB::raw('count(*) as count_orders'), 
                DB::raw('sum(o_pay_money) as sum_moneys'), 
                DB::raw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m-%d' ) as std_day") ]
            )
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

            if ($request->pkind) {
                    $query->where("o_product_kind", $request->pkind);
            }         
            if ($request->sdate) {
                $query->whereRaw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m-%d' ) > '".$request->sdate."'");
            }      
            if ($request->edate) {
                $query->whereRaw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m-%d' ) < '".$request->edate."'");
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
        ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_product_orders.o_member')
        ->groupBy('std_day')
        ->orderBy("o_no","desc")->paginate(6);

        $data['productType'] = Config::get('product.productType');

        $data['start'] = $data["sales"]->total() - $data["sales"]->perPage() * ($data["sales"]->currentPage() - 1);
        $data['total'] = $data["sales"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        //return response($data);
        return view('partner.statistics.day',$data);

    }

    public function sales_month(Request $request)
    {
        if( !$request->y ) $request->y = date("Y"); 
        if( !$request->m ) $request->m = date("m"); 

        $data["statistic"] = [];
        $data["sales"] = $this->FrenchProductOrder
            ->select("french_product_orders.*")
            ->select([
                DB::raw('count(*) as count_orders'), 
                DB::raw('sum(o_pay_money) as sum_moneys'), 
                DB::raw("date_format( date_add(french_product_orders.created_at, interval 3 hour), '%Y-%m' ) as std_day") ]
            )
        ->where(function ($query) use ($request) {
            if ($request->q) {
                    $query->where("o_member_name", "like", "%" . $request->q . "%");
                        //->orwhere("o_title", "like", "%" . $request->q . "%")
            }
            if ($request->y  && $request->m ) {
                $ym = $request->y."-".$request->m;
                $query->where( DB::raw("date_format(french_product_orders.created_at,'%Y-%m')"),  ">=", $ym);
            }

        })
        ->leftjoin('french_members', 'french_members.mb_no', '=', 'french_product_orders.o_member')
        ->groupBy('std_day')
        ->orderBy("o_no","desc")->paginate(6);

        $data['productType'] = Config::get('product.productType');

        $data['start'] = $data["sales"]->total() - $data["sales"]->perPage() * ($data["sales"]->currentPage() - 1);
        $data['total'] = $data["sales"]->total();
        $data['param'] = [
            'state' => $request->state, 
            'sdate' => $request->sdate, 
            'edate' => $request->edate,  
            'pkind' => $request->pkind,             
            'fd' => $request->fd, 
            'q' => $request->q];

        //return response($data);
        return view('partner.statistics.month',$data);

    }    
}
