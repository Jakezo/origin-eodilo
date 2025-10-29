<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_messages', function (Blueprint $table) {
            $table->id('msg_no')->comment('일련번호');
            $table->unsignedInteger('msg_member')->default(0)->comment('작성자');
            $table->string('msg_icon',1)->default('')->comment('아이콘종류');
            $table->string('msg_title',100)->default('')->comment('제목');
            $table->text('msg_cont')->nullable()->comment('내용');
            $table->string('msg_sms',1)->default('N')->comment('SMS여부');
            $table->string('msg_kakao',1)->default('N')->comment('카카오톡여부');
            $table->string('msg_push',1)->default('N')->comment('푸쉬여부');
            $table->string('msg_read',1)->default('N')->comment('확인여부');

            $table->string('msg_sended',1)->default('N')->comment('발송여부');
            $table->datetime('msg_sended_at')->comment('발송시간');
            $table->string('msg_success',1)->default('A')->comment('발송성공여부');

            $table->timestamp('msg_read_at')->comment('사용자확인일시');
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
        Schema::dropIfExists('user_messages');
    }
}
