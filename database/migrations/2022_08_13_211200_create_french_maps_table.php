<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            
            $table->id('m_no')->comment('일련번호번호');
            $table->string('m_bg',255)->default('')->comment('배경이미지');
            $table->string('m_name',50)->default('')->comment('배치도이름');
            $table->unsignedInteger('m_width')->default(1000)->comment('가로크기');
            $table->unsignedInteger('m_height')->default(500)->comment('세로크기');
            $table->text('m_map')->default('')->comment('맵포지션정보');

            $table->timestamps();
            $table->SoftDeletes();
        };

        config(["database.connections.partner.database" => "boss_enha44"]);
        Schema::connection('partner')->create('french_maps', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('french_maps');
    }
}
