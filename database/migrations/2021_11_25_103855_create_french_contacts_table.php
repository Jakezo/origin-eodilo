<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class CreateFrenchContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fnBlueprint = function (Blueprint $table) {
            $table->id('c_no')->comment('일련번호번호');
            $table->unsignedInteger('c_partner')->default(0)->comment('파트너번호');
            $table->string('c_name',50)->default('')->comment('상호명');
            $table->string('c_empname',50)->default('')->comment('담당자이름');
            $table->string('c_phone',20)->default('')->comment('연락처');
            $table->string('c_email',30)->default('')->comment('이메일');
            $table->text('c_cont')->nullable()->comment('기타');
            $table->timestamps();
            $table->SoftDeletes();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_contacts', $fnBlueprint);        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_contacts');        
    }
}
