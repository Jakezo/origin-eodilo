<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('e_no')->comment('일련번호');
            $table->unsignedInteger('e_partner')->default(0)->comment('파트너번호');
            $table->unsignedInteger('e_admin')->default(0)->comment('작성관리자번호'); 
            $table->unsignedInteger('e_manager')->default(0)->comment('작성직원번호'); 
            $table->date('e_sdate',0)->default('0000-00-00')->comment('시작일');
            $table->date('e_edate',0)->default('0000-00-00')->comment('종료일');
            $table->string('e_type',1)->default('A')->comment('할인타입제목');  ## A 할인없음 P 금액 또는 R 할인율
            $table->unsignedInteger('e_value',0)->default(0)->comment('할인값');
            $table->string('e_title',100)->default('')->comment('제목');
            $table->text('e_cont')->default('')->comment('내용');
            $table->text('e_cont2')->default('')->comment('이벤트 유의사항');

            $table->string('e_img1',100)->default('')->comment('목록이미지');
            $table->string('e_img2',100)->default('')->comment('상세이미지1');
            $table->string('e_img3',100)->default('')->comment('상세이미지2');

            $table->string('e_open',1)->default('N')->comment('공개여부');
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
        Schema::dropIfExists('events');
    }
}
