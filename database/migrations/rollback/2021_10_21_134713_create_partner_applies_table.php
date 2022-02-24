<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_applies', function (Blueprint $table) {
            $table->id('app_no');
            $table->string('app_title',50)->default('');            
            $table->string('app_name', 20)->default('');
            $table->string('app_phone', 20)->default('');
            $table->string('app_address', 50)->default('');
            $table->char('app_state',1)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_applies');
    }
}
