<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {   
            $table->id('att_no')->comment('일련번호');
            $table->unsignedInteger('att_rv')->default(0)->comment('예약번호');
            $table->unsignedInteger('att_member')->default(0)->comment('회원'); // 로컬회원
            $table->char('att_state',1)->default('A')->comment('출석여부 A:출석 X:결석');
            $table->date('att_date')->default('0000-00-00')->comment('이용일');
            $table->timestamp('att_in')->comment('최초입실일시');
            $table->timestamp('att_out')->comment('최종퇴실일시');
            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha44"]);
        Schema::connection('partner')->create('french_attends', $fnBlueprint);   

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha44"]);
        Schema::connection('partner')->dropIfExists('french_attends');
    }
}
