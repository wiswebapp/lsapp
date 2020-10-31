<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('iAdminId')->unsigned();
            $table->integer('iGroupId')->default(NULL);
            $table->string('vName');
            $table->string('vEmail');
            $table->string('vMobile');
            $table->string('vPassword');
            $table->string('vImage');
            $table->enum('eStatus',['Active','InActive'])->default('Active');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('admin');
    }
}
