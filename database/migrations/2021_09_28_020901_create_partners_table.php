<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {

            $table->id('p_no')->comment('일련번호');;

            $table->string('p_id', 20)->default('')->unique()->comment('아이디');
            $table->string('p_name', 20)->default('')->comment('가맹점명');
            $table->string('p_bizno', 20)->default('')->comment('사업자번호');
            $table->string('p_ceo', 20)->default('')->comment('대표자명');
            $table->string('p_email', 50)->default('')->comment('대표이메일');
            $table->string('p_passwd', 20)->default('')->comment('가맹점번호');
            $table->char('p_type', 1)->default('')->comment('타입');
            $table->string('p_img1', 100)->default('')->comment('대표이미지');
            $table->string('p_phone', 20)->default('')->comment('연락처');
            $table->string('p_homepage', 100)->default('')->comment('홈페이지주소');
            $table->string('p_kind', 1)->default("A")->comment('종류');
            $table->string('p_emp_name', 20)->default('')->comment('담당자명');
            $table->string('p_emp_hphone', 20)->default('')->comment('담당자핸드폰');
            $table->string('p_emp_email', 50)->default('')->comment('담당자이메일');
            $table->string('p_emp_duty', 20)->default('')->comment('담당자직책');
            $table->char('p_kiosk_type', 1)->default('')->comment('키오스크타입');
            $table->float('p_fee')->default(0)->comment('수수료');
            $table->string('p_fcm_id', 20)->default('')->comment('FCM코드');
            $table->char('p_state', 1)->default('N')->comment('상태');
            $table->string('p_zipcode', 10)->default('')->comment('우편번호');
            $table->string('p_address1', 150)->default('')->comment('주소1');
            $table->string('p_address2', 150)->default('')->comment('주소상세');
            $table->string('p_road', 150)->default('')->comment('도로명주소');
            $table->string('p_keyword', 150)->default('')->comment('키워드');
            $table->char('p_map_use', 1)->default('N')->comment('지도공개');
            $table->decimal('p_map_latitude', $precision = 10, $scale = 5)->default(0)->comment('좌표X');
            $table->decimal('p_map_longitude', $precision = 10, $scale = 5)->default(0)->comment('좌표Y');
            $table->string('p_work_time',100)->default('')->comment('영업시간');
            $table->string('p_work_close',100)->default('')->comment('마감시간');
            $table->string('p_parking')->default('',100)->comment('주차정보');
            $table->text('p_intro')->default('')->comment('간단한소개');
            $table->char('p_time_full', 1)->default('N')->comment('24시간운영');
            $table->longtext('p_contents')->default('')->comment('소개');
            $table->text('p_memo')->default('')->comment('관리자메모');
            $table->string('p_options',30)->default('')->comment('옵션여부');
            $table->string('p_options_cont',255)->default('')->comment('옵션텍스트');

            $table->unsignedInteger('p_like')->default(0)->comment('좋아요수');
            $table->unsignedInteger('p_view')->default(0)->comment('조회수');
            $table->unsignedInteger('p_seq')->default(0)->comment('순서');
            $table->unsignedInteger('p_login_count')->default(0)->comment('로그인횟수');

            $table->string('p_open_mobile',1)->default('N')->comment('모바일사용여부');
            $table->string('p_open_kiosk',1)->default('N')->comment('키오스크사용여부'); 

            $table->unsignedInteger('p_review_count',)->default(0)->comment('리뷰갯수');
            $table->decimal('p_review_avg')->default(0)->comment('리뷰평점');

            $table->date('p_last_dt',0)->comment('마지막로그인');
            $table->string('p_dong', 20)->default('')->comment('동구분');
            $table->string('p_bank_name', 20)->default('')->comment('계좌은행');
            $table->string('p_bank_account', 20)->default('')->comment('계좌번호');
            $table->string('p_bank_user', 20)->default('')->comment('계좌예금주');
            $table->string('p_server', 20)->default('')->comment('서버');
            $table->index('p_id');
            $table->index('p_view');
            $table->index('p_like');
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
        Schema::dropIfExists('partners');
    }
}
