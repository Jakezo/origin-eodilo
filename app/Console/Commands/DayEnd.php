<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\FrenchProductOrder;
use App\Models\FrenchReservSeat;
use App\Models\PartnerCalculate;
use App\Models\Partner;
//use App\Http\Classes\AlarmPush;
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
        // $post = [
        //     'partner_no' => $partner->p_no,
        // ];

        //$headers[] = 'X-IB-Client-Id: 발급받은ID';
        $headers[] = '';

        $ch = curl_init("https://admin.eodilo.com/dayEnd");

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
            
        return Command::SUCCESS;
    }
}
