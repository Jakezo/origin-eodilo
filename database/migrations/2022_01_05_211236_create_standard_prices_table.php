<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandardPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_prices', function (Blueprint $table) {
            $table->id('sl_no')->comment('일련번호');
            $table->string('sl_name',20)->default('')->comment('구분명');
            $table->char('sl_type',1)->default('S')->comment('타입');
            $table->text('sl_price_time')->nullable()->comment('시간금액정보');
            $table->text('sl_price_day')->nullable()->comment('기간금액정보');

            $table->text('sl_rate_student_time')->nullable()->comment('학생시간할인율');
            $table->text('sl_rate_student_day')->nullable()->comment('학생기간할인율');
            $table->text('sl_rate_adult_time')->nullable()->comment('성인시간할인율');
            $table->text('sl_rate_adult_day')->nullable()->comment('성인기간할인율');

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
        Schema::dropIfExists('standard_prices');
    }
}
