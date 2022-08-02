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
            $table->id('cal_no')->comment('일련번호');
            $table->unsignedInteger('cal_partner')->default(0)->comment('일련번호');
            $table->date('cal_date')->nullable()->comment('정산기준일');
            $table->biginteger('cal_revenue')->default(0)->comment('수익');
            $table->biginteger('cal_commission')->default(0)->comment('커미션');
            $table->biginteger('cal_reserve_count')->default(0)->comment('예약(사용)건수');
            $table->char('cal_status', 1)->default('A')->comment('정산여부 ( A:산출 C:송금');

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
        Schema::dropIfExists('partner_calculates');
    }
}
