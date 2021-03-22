<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('categories')) return;
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->char('name',55);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
