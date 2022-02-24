<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrenchAccountBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $fnBlueprint = function (Blueprint $table) {   
            $table->id('ab_no')->comment('일련번호');
            $table->date('ab_date')->comment('날자');
            $table->char('ab_kind',1)->default('')->comment('입출금구분');
            $table->unsignedInteger('ab_div')->default(0)->comment('항목');
            $table->unsignedInteger('ab_user')->default(0)->comment('작성자');
            $table->string('ab_cont',100)->default('')->comment('내용');
            $table->bigInteger('ab_amount')->default(0)->comment('금액');
            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_account_books', $fnBlueprint);   

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_account_books');
    }
}

