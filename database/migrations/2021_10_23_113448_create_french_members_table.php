<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            $table->id('mb_no')->unique()->comment('일련번호');
            $table->string('mb_id', 20)->unique()->comment('아이디');
            $table->string('password', 100)->default('')->comment('비밀번호');
            $table->string('mb_name', 20)->default('')->comment('이름');
            $table->string('mb_sex', 1)->default('A')->comment('성별');
            $table->date('mb_birth')->comment('생년월일');
            $table->string('mb_email', 50)->default('')->comment('이메일');
            $table->string('mb_phone', 20)->default('')->comment('핸드폰');
            $table->string('mb_login_last', 20)->default('')->comment('마지막로그인');
            $table->string('mb_login_ip', 20)->default('')->comment('로그인IP');
            $table->char('mb_state',1)->default('N')->comment('상태 B:블락');
            $table->string('mb_tags',20)->default('')->comment('태그');
            $table->string('mb_memo',255)->default('')->comment('메모');
            $table->integer('mb_user')->default(0)->comment('은하회원번호');
            $table->SoftDeletes();
            $table->timestamps();
            $table->index('mb_id');
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_members', $fnBlueprint);    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_members');
    }
}
