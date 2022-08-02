<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIotLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iot_logs', function (Blueprint $table) {
            $table->id('log_no')->comment('일련번호');
            $table->string('log_partner',10)->default('')->nullable()->comment('요청 파트너');
            $table->string('log_base',2)->default('')->nullable()->comment('요청 파트너구분');
            $table->string('log_dev',4)->default('')->nullable()->comment('요청 DEVICE');
            $table->string('log_iot',10)->default('')->nullable()->comment('요청 IOT');
            $table->string('log_request',4)->default('')->nullable()->comment('요청 상태');
            $table->string('log_data',255)->default('')->nullable()->comment('결과 데이터');
            $table->string('log_topic',20)->default('')->nullable()->comment('TOPIC 데이터');
            $table->string('log_status',4)->default('')->nullable()->comment('결과 상태');
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
        Schema::dropIfExists('iot_logs');
    }
}
