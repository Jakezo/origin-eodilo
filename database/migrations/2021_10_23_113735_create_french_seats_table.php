<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            $table->id('s_no')->comment('일련번호');
            $table->unsignedInteger('s_partner')->default(0)->comment('가맹점번호');
            $table->unsignedInteger('s_room')->default(0)->comment('룸번호');
            $table->unsignedInteger('s_level')->default(0)->comment('좌석등급');
            $table->string('s_name',50)->default('')->comment('좌석명');
            $table->string('s_img',50)->default('')->comment('좌석이미지');
            $table->char('s_state',1)->default('')->comment('상태(0:미사용, 1:사용)');
            $table->string('s_iot1',20)->default('')->comment("IOT1");
            $table->string('s_iot2',20)->default('')->comment("IOT2");
            $table->string('s_iot3',20)->default('')->comment("IOT3");
            $table->string('s_iot4',20)->default('')->comment("IOT4");
            $table->string('s_iot_ext',50)->default('')->comment("추가IOT");
            $table->string('s_item',10)->default('')->comment('요금종류');
            $table->string('s_device',10)->default('')->comment('노출디바이스');
            $table->string('s_age',10)->default('')->comment('나이구분');
            $table->unsignedInteger('s_map_x')->default(0)->comment('X좌표');
            $table->unsignedInteger('s_map_y')->default(0)->comment('Y좌표');
            $table->unsignedInteger('s_map_w')->default(0)->comment('너비');
            $table->unsignedInteger('s_map_h')->default(0)->comment('높이');
            $table->unsignedInteger('s_map_r')->default(0)->comment('회전각도');
            $table->char('s_open_kiosk',1)->default('Y')->comment('키오스크판매여부');
            $table->char('s_open_mobile',1)->default('Y')->comment('모바일판매여부');

            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_seats', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_seats');
    }
}
