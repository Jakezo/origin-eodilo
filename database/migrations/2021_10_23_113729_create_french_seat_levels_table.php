<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchSeatLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            $table->id('sl_no')->comment('일련번호');
            $table->unsignedInteger('sl_partner')->default(0)->comment('가맹점번호');
            $table->string('sl_name',20)->default('')->comment('구분명');
            $table->char('sl_type',1)->default('S')->comment('타입');
            $table->text('sl_price_time')->default('')->comment('시간금액정보');
            $table->text('sl_price_day')->default('')->comment('기간금액정보');

            $table->text('sl_rate_student_time')->float(5,2)->comment('학생시간할인율');
            $table->text('sl_rate_student_day')->default(5,2)->comment('학생기간할인율');
            $table->text('sl_rate_adult_time')->default(5,2)->comment('성인시간할인율');
            $table->text('sl_rate_adult_day')->default(5,2)->comment('성인기간할인율');

            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_seat_levels', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_seat_levels');
    }
}
