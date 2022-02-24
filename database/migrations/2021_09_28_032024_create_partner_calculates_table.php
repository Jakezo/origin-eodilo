<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerCalculatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_calculates', function (Blueprint $table) {
            $table->id('cal_no')->default(0)->comment('일련번호');
            $table->string('cal_brach', 45);
            $table->date('cal_date');
            $table->integer('cal_price');
            $table->integer('cal_use_count');
            $table->string('cal_admin', 20);
            $table->char('cal_status', 1);

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
        Schema::dropIfExists('partner_calculates');
    }
}
