<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_applies', function (Blueprint $table) {
            $table->id('app_no');
            $table->string('app_title',70)->default('제목/가맹점명');  
            $table->text('app_cont')->nullable()->comment("상세내욕");            
            $table->string('app_name', 20)->default('')->comment("작성자");  
            $table->string('app_phone', 20)->default('')->comment("연락처");  
            $table->string('app_address', 50)->default('')->comment("주소");  
            $table->char('app_state',1)->default('')->comment("상태");  
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
        Schema::dropIfExists('partner_applies');
    }
}
