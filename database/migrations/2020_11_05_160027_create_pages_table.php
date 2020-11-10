<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('iPageId')->unsigned();
            $table->string('vPageName');
            $table->string('vTitle');
            $table->string('vSlug');
            $table->text('tMetaKeyword');
            $table->text('tMetaDescription');
            $table->longtext('tDescription');
            $table->string('vImage');
            $table->enum('eStatus',['Active','InActive'])->default('Active');
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
        Schema::dropIfExists('pages');
    }
}
