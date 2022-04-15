<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchIotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            
            $table->id('i_no')->comment('일련번호번호');
            $table->unsignedInteger('i_partner')->default(0)->comment('파트너번호');
            $table->string('i_name',50)->default('')->comment('룸이름');
            $table->char('i_sex',1)->default('M')->comment('파트너번호'); // A : 제한없음 M : 남자 F : 여자
            $table->char('i_type',1)->default('R')->comment('구분'); // R : 룸 S : 스터디룸
            $table->string('i_iot1',20)->default('')->comment('IOT1');
            $table->string('i_iot2',20)->default('')->comment('IOT2');
            $table->string('i_iot3',20)->default('')->comment('IOT3');
            $table->string('i_iot4',20)->default('')->comment('IOT4');
       
            $table->timestamps();
            $table->SoftDeletes();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_iots', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_iots');
    }
}
