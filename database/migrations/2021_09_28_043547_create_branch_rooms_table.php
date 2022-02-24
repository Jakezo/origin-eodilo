<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_rooms', function (Blueprint $table) {

            $table->id('room_no');
            $table->string('room_bg',50);
            $table->string('room_name',50);
            $table->unsignedInteger('room_seat_count');
            $table->char('room_state',1);
            $table->char('room_sex',1);
            $table->char('room_map',1);
            $table->char('room_type',1);

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
        Schema::dropIfExists('branch_rooms');
    }
}
