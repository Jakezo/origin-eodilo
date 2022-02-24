<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            
                $table->id('mn_no');
                $table->string('mn_id', 20)->unique();
                $table->string('password', 100)->default('');
                $table->string('mn_name', 20)->default('');
                $table->string('mn_email', 50)->default('');
                $table->string('mn_phone', 20)->default('');
                $table->string('mn_login_last', 20)->default('');
                $table->string('mn_login_ip', 20)->default('');
                $table->char('mn_state',1)->default('N');
                $table->SoftDeletes();
                $table->timestamps();
                $table->index('mn_id');
        };


        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_managers', $fnBlueprint);    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_managers');
    }
}
