<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAuthCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_auth_codes', function (Blueprint $table) {
            $table->id('a_no');
            $table->string('a_kind', 20)->default('')->comment('종류');
            $table->string('a_code', 100)->default('')->comment('인증코드');
            $table->string('a_member', 20)->default('')->comment('회원특정시 회원번호');
            $table->char('a_check',1)->default('N')->comment('인증완료여부');
            $table->datetime('a_check_at')->comment('인증시간');
            $table->datetime('a_lasttime')->comment('종료시간');
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
        Schema::dropIfExists('user_auth_codes');
    }
}
