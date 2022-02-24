<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_reviews', function (Blueprint $table) {
            $table->id('rv_no');
            $table->unsignedInteger('rv_partner');
            $table->unsignedInteger('rv_order');
            $table->unsignedInteger('rv_member');
            $table->string('rv_member_ip',20);
            $table->text('rv_contents');
            $table->string('rv_imgs',1000);
            $table->unsignedInteger('rv_point');
            $table->char('rv_del', 1);
            $table->datetime('rv_del_date');
            $table->char('rv_best', 1);
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
        Schema::dropIfExists('partner_reviews');
    }
}
