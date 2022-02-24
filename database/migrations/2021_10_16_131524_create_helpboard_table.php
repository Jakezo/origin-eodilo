<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpboards', function (Blueprint $table) {
            $table->id('b_no');
            $table->string('b_id',20)->default('');
            $table->unsignedInteger('b_partner')->default(0);
            $table->unsignedInteger('b_level')->default(0);
            $table->unsignedInteger('b_member')->default(0);
            $table->string('b_uname',20)->default('');
            $table->string('b_uemail',50)->default('');
            $table->string('b_title',100)->default('');
            $table->text('b_cont')->default('');
            $table->string('b_files',150)->default('');
            $table->unsignedInteger('b_read')->default(0);
            $table->string('b_state',1)->default('Y');
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
        Schema::dropIfExists('helpboards');
    }
}
