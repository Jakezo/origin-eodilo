<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_coupons', function (Blueprint $table) {
            $table->id('c_no')->comment('일련번호');
            $table->unsignedInteger('c_partner')->default(0)->comment('파트너번호');
            $table->unsignedInteger('c_emp')->default(0)->comment('작성작원번호'); // 가맹점직원
            $table->date('c_sdate',0)->default('0000-00-00')->comment('시작일');
            $table->date('c_edate',0)->default('0000-00-00')->comment('종료일');
            $table->string('c_type',1)->default('A')->comment('할인타입제목');  ## A 할인없음 P 금액 또는 R 할인율
            $table->unsignedInteger('c_value',0)->default(0)->comment('할인값');
            $table->string('c_title',100)->default('')->comment('제목');
            $table->text('c_cont')->nullable()->comment('내용');
            $table->string('c_read',1)->default('N')->comment('조회여부');
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
        Schema::dropIfExists('partner_coupons');
    }
}
