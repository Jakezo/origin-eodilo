<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Partner;

class CreatePartnerPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_photos', function (Blueprint $table) {
            $table->id('pt_no')->comment('일련번호');
            $table->unsignedInteger('pt_partner')->default('0')->comment('가맹점');
            $table->string('pt_kind',2)->default('')->comment('종류');
            $table->string('pt_filename',150)->default('')->comment('파일명');
            $table->integer('pt_seq')->default(0)->comment('정렬순서');
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
        Schema::dropIfExists('partner_photos');
    }
}
