<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            $table->id('l_no')->comment('일련번호');
            $table->unsignedInteger('l_partner')->default(0)->comment('가맹점번호');
            $table->string('l_name',20)->default('')->comment('사물함이름');
            $table->unsignedInteger('l_area')->default(0)->comment('구역번호');
            $table->string('l_dvc_no',20)->default('')->comment('디바이스번호');
            $table->SoftDeletes();

            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_lockers', $fnBlueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_lockers');
    }
}
