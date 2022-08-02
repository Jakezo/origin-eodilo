<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\PartnerCalculate;
use App\Models\Partners;
use App\Http\Classes\AlarmPush;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Exception;

class DayEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Scheduler:DayEnd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '가맹점 업무마감시간에 맞춰 마감업무를 실행합니다.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->handle();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $data = [];

        $exec_date = now();
        $partners = \App\Models\Partner::select("p_no","p_id","p_name","p_deadline_time","p_deadline_exec","p_commission")
        //->where("p_deadline_exec","<>", $exec_date->format("Y-m-d") )
        //->where("p_deadline_time",">", $exec_date->format("H:i:s") )
        ->get();   
        
        foreach( $partners as $partner ) {

                // DB::enableQueryLog();	//query log 시작 선언부
                // 업무마감시간
                $deadline_time = $partner->p_deadline_time;
                $commission = $partner->p_commission;
                $data["reserves"] = [];
                $deadline = [];

                ## 오후 6시 이후면 금일마감으로 
                if( $deadline_time >= "18:00:00" ) {
                    $calculateDate = now()->format("Y-m-d");
                } elseif( $deadline_time <= "06:00:00" ) { 
                    $calculateDate = now()->addDay(-1)->format("Y-m-d");
                } else {
                    
                }

                //$deadline['sdate'] = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s',  now()->addDay(-1)->format("Y-m-d " . $deadline_time));
                $deadline['sdate'] = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s',  now()->addDay(-5)->format("Y-m-d " . $deadline_time));
                $deadline['edate'] = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s',  now()->format("Y-m-d " . $deadline_time));

                ## 
                Config::set('database.connections.partner.database',"boss_".$partner->p_id);

                $data["reserves"] = \App\Models\FrenchReservSeat::leftJoin("french_product_orders", "french_product_orders.o_no", "french_reserv_seats.rv_order")
                ->where(function ($query) use ($deadline) {
                        if( isset($deadline['sdate']) ) {
                            $query->where('rv_sdate', '>', $deadline['sdate']);
                            $query->where('rv_edate', '>', $deadline['sdate']);
                        }

                            //$query->whereIn("rv_product_kind",['A','D','T','F','P']);
                            //->whereIn("rv_product_kind",['A'])
                            // ->orwhere([
                            //     ['rv_edate', '>=', now()->addDay(-1)->format("Y-m-d " . $deadline_time),
                            //     ['rv_edate', '<=', now()->addDay(-1)->format("Y-m-d " . $deadline_time),
                            // ]);
                })
                //->where("rv_state_seat","END")
                ->get();
                
                $calc_sum_revenue = 0;
                $calc_sum_commission = 0; 
                $calc_reserve_count = 0;

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
                    $partnerCalculate->cal_revenue = $revenue[$r]['revenue'] ?? 0;;
                    $partnerCalculate->cal_commission = $revenue[$r]['commission'] ?? 0;
                    $partnerCalculate->cal_status = "A";
                    $partnerCalculate->save();
                }

                $partner->p_deadline_exec = $exec_date->format("Y-m-d");
                $partner->update();
        }
            
        return Command::SUCCESS;
    }
}
