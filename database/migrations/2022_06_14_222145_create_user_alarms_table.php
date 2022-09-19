<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_alarms', function (Blueprint $table) {

            $table->id('a_no')->comment('일련번호');
            $table->unsignedInteger('a_user')->default(0)->comment('모바일회원');
            $table->unsignedInteger('a_partner')->default(0)->comment('파트너구분');
            $table->unsignedInteger('a_member')->default(0)->comment('회원');
            $table->char('a_kind',1)->default('P')->comment('종류 P:푸시, M:문자, K:카카오알림톡');
            $table->char('a_type',1)->default('0')->comment('0:아이콘없음 1:경고 2:알림 3:완료');
         
            $table->string('a_title',100)->default('')->comment('제목');
            $table->string('a_body',255)->default('')->comment('내용');
            $table->char('a_send',1)->default('N')->comment('전송여부');
            $table->char('a_receive',1)->default('N')->comment('발송여부');
            $table->string('a_multicast_id',50)->default('')->comment('메세지묶음구분');
            $table->string('a_message_id',50)->default('')->comment('메세지아이디');

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
        Schema::dropIfExists('user_alarms');
    }
}
