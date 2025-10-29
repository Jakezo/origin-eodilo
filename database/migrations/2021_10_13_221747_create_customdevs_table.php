<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomdevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customdevs', function (Blueprint $table) {
            $table->id('q_no')->comment('일련번호');
            $table->unsignedInteger('q_partner')->default(0)->comment('파트너번호');
            $table->unsignedInteger('q_member')->default(0)->comment('작성자');
            $table->string('q_uname',20)->default('')->comment('작성자명');
            $table->string('q_uemail',50)->default('')->comment('작성자이메일');
            $table->string('q_title',100)->default('')->comment('제목');
            $table->text('q_cont')->nullable()->comment('내용');
            $table->string('q_file',150)->default('')->comment('첨부파일');
            $table->string('q_read',1)->default('N')->comment('조회여부');
            $table->string('a_answer',1)->default('N')->comment('답변여부');
            $table->timestamp('a_answer_at')->comment('답변일시');
            $table->unsignedInteger('a_admin')->default(0)->comment('답변작성자');
            $table->string('a_title',100)->default('')->comment('답변제목');
            $table->text('a_cont')->nullable()->comment('답변내용');
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
        Schema::dropIfExists('customdevs');
    }
}
