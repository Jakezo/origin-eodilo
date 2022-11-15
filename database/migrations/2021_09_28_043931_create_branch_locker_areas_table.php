<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchLockerAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_locker_areas', function (Blueprint $table) {
            $table->id('la_no');
            $table->string('la_bg',50);
            $table->string('la_name',50);
            $table->unsignedInteger('la_locker_count');
            $table->char('la_locker_state',1);
            $table->char('room_sex',1);
            $table->char('la_locker_open_kiosk',1);
            $table->char('la_locker_open_mobile',1);

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
        Schema::dropIfExists('branch_locker_areas');
    }
}
