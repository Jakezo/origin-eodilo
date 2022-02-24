<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {   

            $table->id('prd_no')->comment('일련번호');
            $table->string('prd_A',255)->default('')->comment('하루이용권'); 
            $table->string('prd_T',255)->default('')->comment('시간권'); 
            $table->string('prd_D',255)->default('')->comment('기간'); 
            $table->string('prd_F',255)->default('')->comment('고정'); 
            $table->string('prd_P',255)->default('')->comment('포인트'); 
            
            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_products', $fnBlueprint);
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_products');
    }
}
