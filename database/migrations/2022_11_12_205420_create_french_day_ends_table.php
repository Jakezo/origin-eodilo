<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchDayEndsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $fnBlueprint = function (Blueprint $table) {        
            $table->id('de_no')->comment('일련번호');
            $table->date('de_date')->default('0000-00-00')->comment('실행일'); 
            $table->string('de_command1',1)->default('N')->nullable()->comment('Command1');
            $table->string('de_command2',1)->default('N')->nullable()->comment('Command2');
            $table->string('de_command3',1)->default('N')->nullable()->comment('Command3');
            $table->string('de_command4',1)->default('N')->nullable()->comment('Command4');  
            $table->SoftDeletes();        
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha44"]);
        Schema::connection('partner')->create('french_day_ends', $fnBlueprint);
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('french_day_ends');
    }
}
