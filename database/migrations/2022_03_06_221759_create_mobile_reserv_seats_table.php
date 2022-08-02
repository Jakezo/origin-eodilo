<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileReservSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_reserv_seats', function (Blueprint $table) {
            $table->id('rv_no')->comment('일련번호');
            $table->unsignedInteger('rv_partner_rv')->default(0)->comment('파트너예약일련번호');
            $table->unsignedInteger('rv_partner')->default(0)->comment('파트너번호');
            $table->unsignedInteger('rv_partner_order')->default(0)->comment('파트너구매번호');
            $table->unsignedInteger('rv_order')->default(0)->comment('구매번호');
            $table->unsignedInteger('rv_member_from')->default(0)->comment('회원구분'); // 회원 E, L
            $table->unsignedInteger('rv_member')->default(0)->comment('회원'); // 로컬회원
            $table->string('rv_member_name', 30)->default('')->comment('회원명'); // 로컬회원            
            $table->string('rv_ageType',1)->default('A')->comment('연령타입'); // A : 성인 S : 학생    
            $table->string('rv_priceType',1)->default('A')->comment('금액타입'); // A : 기본 N : 신규 X: 확장    
            $table->string('rv_sex',1)->default('A')->comment('성별'); // M : 남자 F : 여자
            $table->string('rv_device_from',1)->default(0)->comment('구매디바이스구분'); // A 창구 ,  M 모바일, K 키오스크
            $table->unsignedInteger('rv_room')->default(0)->comment('룸');
            $table->unsignedInteger('rv_seat')->default(0)->comment('좌석'); 
            $table->string('rv_seat_name',10)->default('')->comment('좌석명'); 
            $table->unsignedInteger('rv_seat_level')->default(0)->comment('좌석등급'); 
            $table->string('rv_product_kind',1)->default('A')->comment('상품종류');  // A 1일이용권 , P 정약권, F 고정권 T 시간권, D 기간권 등..
            $table->string('rv_product_name',30)->default('A')->comment('상품명');  // A 1일이용권 , P 정약권, F 고정권 T 시간권, D 기간권 등..
            $table->Integer('rv_duration')->default(0)->comment('기간');  
            $table->string('rv_duration_type',1)->default('')->comment('기간종류'); // D , M   
            $table->string('rv_type',1)->default('C')->comment('예약여부'); // C : 일반 R : 예약
            $table->datetime('rv_sdate',0)->default('0000-00-00 00:00:00')->comment('시작일');
            $table->datetime('rv_edate',0)->default('0000-00-00 00:00:00')->comment('종료일');
            $table->string('rv_state',1)->default('R')->comment('상태'); // A 예약 , U 사용중, Z  사용완료
            $table->string('rv_state_seat',4)->default('')->comment('상태'); // IN 입실중  OUT 외출중
            $table->string('rv_state_seat_in',0)->default('0000-00-00 00:00:00')->comment('입실일시'); // 외출/복귀시 업데이트
            $table->string('rv_state_seat_out',0)->default('0000-00-00 00:00:00')->comment('외출일시');// 외출/복귀시 업데이트
            
            $table->unsignedInteger('rv_duration_time')->default(0)->comment('예약기간-초단위');
            $table->unsignedInteger('rv_used_time')->default(0)->comment('실제사용기간-초단위');

            $table->string('rv_pass',20)->default('')->comment('패스워드');
            $table->datetime('rv_pass_last')->default('0000-00-00 00:00:00')->comment('패스워드유효시간');

            $table->string('rv_calc',1)->default('N')->comment('정산여부');// 은하에서 정산여부
            $table->string('rv_calc_dt',0)->default('0000-00-00 00:00:00')->comment('정산일');// 은하에서 정산일시
            $table->string('rv_memo',255)->comment('메모'); 
            
            $table->unsignedInteger('rv_alrarm_05')->default(0)->comment('알라람발송여부: 05분전');
            $table->unsignedInteger('rv_alarm_30')->default(0)->comment('알라람발송여부: 30분전');
            
            $table->SoftDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_reserv_seats');
    }
}
