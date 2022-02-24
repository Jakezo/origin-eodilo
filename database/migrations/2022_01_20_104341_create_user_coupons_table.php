<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->id('uc_no');
            $table->integer('uc_user')->default(0)->comment('회원번호');
            $table->integer('uc_partner')->default(0)->comment('파트너번호');
            $table->integer('uc_coupon')->default(0)->comment('쿠폰번호');
            $table->char('uc_used',1)->default('N')->comment('사용여부');
            $table->integer('uc_used_at')->comment('사용시간');
            $table->integer('uc_used_order')->default(0)->comment('관련구매내역');
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
        Schema::dropIfExists('user_coupons');
    }
}
