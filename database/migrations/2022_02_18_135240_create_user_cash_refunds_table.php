<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCashRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cash_refunds', function (Blueprint $table) {
            $table->id('cr_no')->comment('일련번호');
            $table->unsignedInteger('cr_member')->default(0)->comment('회원');
            $table->BigInteger('cr_cash')->default(0)->comment('신청캐쉬');
            $table->BigInteger('cr_money')->default(0)->comment('환불금액');
            $table->char('cr_refund',1)->default('N')->comment('구매/결제여부');
            $table->Integer('cr_manager',)->default(0)->comment('담당자');
            $table->string('cr_bank',50)->default('')->comment('환불계좌은행');
            $table->string('cr_back_account',50)->default('')->comment('환불계좌번호');
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
        Schema::dropIfExists('user_cash_refunds');
    }
}
