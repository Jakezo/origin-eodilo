<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerRegsTable extends Migration
{
    /** 파트너 계약
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_regs', function (Blueprint $table) {
            $table->id('pr_no');
            $table->unsignedInteger('pr_partner')->default(0)->comment('파트너번호');
            $table->date('pr_sdate',0)->default('0000-00-00')->comment('시작일');
            $table->date('pr_edate',0)->default('0000-00-00')->comment('종료일');
            $table->unsignedInteger('pr_admin')->default(0)->comment('담당자번호');
            $table->string('pr_pay')->default('N')->comment('결제여부'); // N 무료 / Y 유료
            $table->string('pr_pay_kind')->default('')->comment('결제방법');  // C : 카드결제 / B : 입금
            $table->string('pr_pay_money')->default(0)->comment('결제금액');
            $table->text('pr_memo')->nullable();
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
        Schema::dropIfExists('partner_regs');
    }
}
