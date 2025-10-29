<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_faqs', function (Blueprint $table) {
            $table->id('q_no')->comment('일련번호');
            $table->string('q_kind',20)->default('')->comment('분류');
            $table->string('q_title',100)->default('')->comment('제목');
            $table->text('q_cont')->nullable()->comment('내용');
            $table->unsignedInteger('q_seq')->default(0)->comment('순서');
            $table->unsignedInteger('q_top')->default(0)->comment('Top 순서');
            $table->unsignedInteger('q_read')->default(0)->comment('조회수');
            $table->SoftDeletes();
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
        Schema::dropIfExists('custom_faqs');
    }
}
