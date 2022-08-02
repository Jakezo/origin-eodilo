<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $fnBlueprint = function (Blueprint $table) {       

            $table->id('o_no')->comment('일련번호');
            $table->unsignedInteger('o_partner')->default(0)->comment('파트너번호');
            $table->unsignedInteger('o_member_from')->default(0)->comment('회원구분'); // 회원 E, L
            $table->unsignedInteger('o_member')->default(0)->comment('회원'); // 로컬회원
            $table->string('o_member_name', 30)->default('')->comment('회원명'); // 로컬회원            
            $table->string('o_ageType',1)->default('A')->comment('연령타입'); // A : 성인 S : 학생
            $table->string('o_priceType',1)->default('A')->comment('금액타입'); // A : 기본 N : 신규 X: 확장  

            $table->string('o_device_from',1)->default(0)->comment('구매디바이스구분'); // A 창구 ,  M 모바일, K 키오스크
            $table->unsignedInteger('o_room')->default(0)->comment('룸');
            $table->unsignedInteger('o_seat')->default(0)->comment('좌석'); 
            $table->string('o_seat_name',10)->default('')->comment('좌석명'); 
            $table->unsignedInteger('o_seat_level')->default(0)->comment('좌석등급'); 
            $table->string('o_product_kind',1)->default('A')->comment('상품종류');  // A 1일이용권 , P 정약권, F 고정권 T 시간권, D 기간권 등..
            $table->string('o_product_name',30)->default('A')->comment('상품명');  // A 1일이용권 , P 정약권, F 고정권 T 시간권, D 기간권 등..
            $table->Integer('o_duration')->default(0)->comment('기간');  
            $table->string('o_duration_type',1)->default('')->comment('기간종류'); // D , M  

            $table->Integer('o_remainder')->default(0)->comment('잔여존재통합');
            $table->Integer('o_remainder_time')->default(0)->comment('잔여시간');
            $table->Integer('o_remainder_day')->default(0)->comment('잔여기간'); 
            $table->Integer('o_remainder_point')->default(0)->comment('잔여포인트'); 
            
            $table->datetime('o_sdate',0)->default('0000-00-00 00:00:00')->comment('시작일');
            $table->datetime('o_edate',0)->default('0000-00-00 00:00:00')->comment('종료일');

            $table->unsignedInteger('o_price_seat')->default(0)->comment('좌석금액'); 


            $table->string('o_locker_use',1)->default('N')->comment('사물함사용여부'); 
            $table->Integer('o_locker')->default(0)->comment('사물함번호'); 
            $table->string('o_locker_name',10)->default('')->comment('사물함명'); 
            $table->unsignedInteger('o_price_locker')->default(0)->comment('사물함금액'); 

            $table->unsignedInteger('o_price_total')->default(0)->comment('합계금액'); 


            $table->Integer('o_coupon')->default(0)->comment('쿠폰번호');
            $table->unsignedInteger('o_coupon_discount')->default(0)->comment('쿠폰할인');             
            
            $table->Integer('o_pay_cash')->default(0)->comment('캐쉬사용금액'); 
            $table->Integer('o_pay_point')->default(0)->comment('포인트사용금액'); 
            $table->Integer('o_pay_discount')->default(0)->comment('할인금액'); 
            $table->Integer('o_pay_money')->default(0)->comment('결제금액'); 

            $table->string('o_pay_kind',10)->default('LCASH')->comment('결제방법'); // LCASH 가맹점 현금 LCARD 가맹점카드
            $table->string('o_pay_state',1)->default('N')->comment('결제상태'); 
            $table->datetime('o_pay_at',0)->comment('결제일'); 

            $table->string('o_refund',1)->default('N')->comment('환불여부'); 
            $table->datetime('o_refund_at',0)->comment('환불요청일'); 
            $table->datetime('o_refund_price',0)->comment('환불지급액(사용자)'); 
            $table->datetime('o_refund_money',0)->comment('환불수급액(가맹점)'); 
            $table->string('o_refund_memo',255)->comment('환불메모'); 
            $table->string('o_memo',255)->comment('메모'); 

            $table->unsignedInteger('o_member_service')->default(0)->comment('모바일회원'); // 회원
            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_product_orders', $fnBlueprint);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_product_orders');
    }
}
