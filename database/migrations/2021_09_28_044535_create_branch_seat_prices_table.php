<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchSeatPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_seat_prices', function (Blueprint $table) {

            $table->id('seat_no');
            $table->unsignedInteger('p_seat_level');
            $table->char('p_product_type',1);
            $table->unsignedInteger('p_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_seat_prices');
    }
}
