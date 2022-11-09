<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchSeatUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_seat_uses', function (Blueprint $table) {

            $table->id('su_no');
            $table->unsignedInteger('su_member');
            $table->unsignedInteger('su_order');
            $table->unsignedInteger('su_room');
            $table->unsignedInteger('su_seat');
            $table->datetime('su_start_dt');
            $table->datetime('su_end_dt');
            $table->char('su_state',1);
            $table->unsignedInteger('su_usetime');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_seat_uses');
    }
}
