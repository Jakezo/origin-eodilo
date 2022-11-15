<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_lockers', function (Blueprint $table) {
            $table->id('seat_no');
            $table->unsignedInteger('seat_room');
            $table->unsignedInteger('seat_level');
            $table->char('seat_status',1);
            $table->string('seat_power1',20);
            $table->string('seat_power2',20);
            $table->string('seat_power3',20);
            $table->string('seat_power4',20);
            $table->string('seat_item',10);
            $table->string('seat_device',10);
            $table->string('seat_age',10);

            $table->Integer('seat_map_x');
            $table->Integer('seat_map_y');
            $table->Integer('seat_map_w');
            $table->Integer('seat_map_h');
            $table->Integer('seat_map_ro');

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
        Schema::dropIfExists('branch_lockers');
    }
}
