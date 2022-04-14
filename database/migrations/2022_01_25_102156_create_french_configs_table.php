<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $fnBlueprint = function (Blueprint $table) {   
            $table->id();
            $table->string('cf_bg')->default('')->comment('배경이미지');
            $table->unsignedInteger('cf_bg_width')->default(0)->comment('배치도가로편집사이즈');
            $table->unsignedInteger('cf_bg_height')->default(0)->comment('배치도세로편집사이즈');
            $table->string('cf_iot_base',50)->default('')->comment('가맹점 IOT 번호');
            $table->string('cf_iot_seat',50)->default('')->comment('좌석IOT 항목명');
           
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_configs', $fnBlueprint);   

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::dropIfExists('french_configs');
    }
}
