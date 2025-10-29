<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_favorites', function (Blueprint $table) {
            $table->id('fv_no')->comment('파트너번호');
            $table->unsignedInteger('fv_partner')->default(0)->comment('가맹점번호');
            $table->unsignedInteger('fv_user')->default(0)->comment('회원번호');
            $table->char('fv_cancel', 1)->default('N')->comment('취소여부');
            $table->datetime('fv_cancel_dt')->nullable()->comment('취소일시');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_favorites');
    }
}
