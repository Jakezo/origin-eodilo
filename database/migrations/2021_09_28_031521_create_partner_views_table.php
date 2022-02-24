<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_views', function (Blueprint $table) {
            $table->id('v_no');
            $table->unsignedInteger('v_count')->default(0)->comment('횟수');
            $table->unsignedInteger('v_partner')->default(0)->comment('파트너번호');
            $table->unsignedInteger('v_member')->default(0)->comment('회원번호');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_views');
    }
}
