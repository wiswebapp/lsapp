<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('iUserId')->unsigned();
            $table->string('vName');
            $table->string('vEmail')->unique();
            $table->string('vMobile');
            $table->string('vPassword');
            $table->integer('vCountry');
            $table->integer('vState');
            $table->integer('vCity');
            $table->string('vImage');
            $table->enum('eGender',['Male','Female']);
            $table->date('dBirthDate',['Male','Female']);
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
        Schema::dropIfExists('users');
    }
}
