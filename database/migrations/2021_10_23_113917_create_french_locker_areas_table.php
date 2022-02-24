<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchLockerAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            $table->id('la_no')->comment('일련번호');
            $table->string('la_bg',50)->default('')->comment('배경이미지');
            $table->string('la_name',50)->default('')->comment('구역이름');
            $table->unsignedInteger('la_locker_count')->default(0)->comment('사물함갯수');
            $table->char('la_locker_state',1)->default('N')->comment('상태');
            $table->char('la_locker_open_kiosk',1)->default('Y')->comment('키오스크판매여부');
            $table->char('la_locker_open_mobile',1)->default('Y')->comment('모바일판매여부');
            $table->SoftDeletes();

            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_locker_areas', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_locker_areas');
    }
}
