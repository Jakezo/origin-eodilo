<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards_comments', function (Blueprint $table) {
            $table->id('c_no')->comment('일련번호');
            $table->string('c_board',20)->default('')->comment('게시판구분명');
            $table->unsignedInteger('c_parent')->default(0)->comment('글번호');
            $table->unsignedInteger('c_emp')->default(0)->comment('작성자');
            $table->string('c_uname',20)->default('')->comment('작성자명');
            $table->text('c_comments')->nullable()->comment('댓글내용');
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
        Schema::dropIfExists('boards_comments');
    }
}
