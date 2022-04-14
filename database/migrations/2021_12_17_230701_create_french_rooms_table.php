<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            
            $table->id('r_no')->comment('일련번호번호');
            $table->unsignedInteger('r_partner')->default(0)->comment('파트너번호');
            $table->string('r_bg',255)->default('')->comment('배경이미지');
            $table->string('r_name',50)->default('')->comment('룸이름');
            $table->unsignedInteger('r_seat_count')->default(0)->comment('좌석수');
            $table->char('r_state_mobile',1)->default('Y')->comment('모바일사용여부');
            $table->char('r_state_kiosk',1)->default('Y')->comment('키오스크사용여부');
            $table->char('r_sex',1)->default('M')->comment('파트너번호'); // A : 제한없음 M : 남자 F : 여자
            $table->text('r_map')->default('')->comment('맵포지션정보');
            $table->char('r_type',1)->default('R')->comment('구분'); // R : 룸 S : 스터디룸
            $table->string('r_iot1',20)->default('')->comment('IOT1');
            $table->string('r_iot2',20)->default('')->comment('IOT2');
            $table->string('r_iot3',20)->default('')->comment('IOT3');
            $table->string('r_iot4',20)->default('')->comment('IOT4');
       
            $table->timestamps();
            $table->SoftDeletes();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_rooms', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_rooms');
    }
}
