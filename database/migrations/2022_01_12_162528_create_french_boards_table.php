<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $fnBlueprint = function (Blueprint $table) {   
            $table->id('b_no')->comment('일련번호');
            $table->string('b_id',20)->default('')->comment('게시판아이디');
            $table->unsignedInteger('b_partner')->default(0)->comment('가맹점');
            $table->unsignedInteger('b_member')->default(0)->comment('작성자');
            $table->string('b_uname',20)->default('')->comment('작성자명');
            $table->string('b_title',100)->default('')->comment('제목');
            $table->text('b_cont')->default('')->comment('내용');
            $table->string('b_files',150)->default('')->comment('파일');
            $table->unsignedInteger('b_read')->default(0)->comment('조회수');
            $table->unsignedInteger('b_comment')->default(0)->comment('댓글수');
            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_boards', $fnBlueprint);   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::dropIfExists('french_boards');
    }
}
