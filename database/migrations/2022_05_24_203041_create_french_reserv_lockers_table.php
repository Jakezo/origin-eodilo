<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchReservLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {   

            $table->id('rl_no')->comment('일련번호');
            $table->unsignedInteger('rl_partner')->default(0)->comment('파트너번호');
            $table->unsignedInteger('rl_order')->default(0)->comment('구매번호');
            $table->unsignedInteger('rl_locker')->default(0)->comment('사물함번호');
            $table->unsignedInteger('rl_rv')->default(0)->comment('예약번호'); 
            $table->string('rl_state',10)->default('')->comment('상태( END : 종료'); 
            $table->datetime('rl_sdate')->default('0000-00-00 00:00:00')->comment('시작일');
            $table->datetime('rl_edate')->default('0000-00-00 00:00:00')->comment('종료일');
            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_reserv_lockers', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_reserv_lockers');
    }
}
