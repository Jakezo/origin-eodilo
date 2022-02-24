<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchAccountDivsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $fnBlueprint = function (Blueprint $table) {   
            $table->id('d_no')->comment('일련번호');
            $table->string('d_name',30)->default('')->comment('항목명');
            $table->SoftDeletes();            
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_account_divs', $fnBlueprint);   

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_account_divs');
    }
}
