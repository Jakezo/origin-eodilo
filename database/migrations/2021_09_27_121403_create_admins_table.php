<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_no');
            $table->string('admin_id', 20)->unique();
            $table->string('password', 100)->default('');
            $table->string('admin_name', 20)->default('');
            $table->string('admin_email', 50)->default('');
            $table->string('admin_phone', 20)->default('');
            $table->string('admin_login_last', 20)->default('');
            $table->string('admin_login_ip', 20)->default('');
            $table->char('admin_state',1)->default('N');
            $table->SoftDeletes();
            $table->rememberToken();            
            $table->timestamps();
            $table->index('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
