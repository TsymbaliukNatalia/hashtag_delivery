<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTtnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('ttns')) return;
        Schema::create('ttns', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date_create');
            $table->integer('creater_id')->unsigned();
            $table->foreign('creater_id')->references('id')->on('employees');
            $table->integer('courier_id')->unsigned();
            $table->foreign('courier_id')->references('id')->on('employees');
            $table->integer('from_city')->unsigned();
            $table->foreign('from_city')->references('id')->on('cities');
            $table->integer('to_city')->unsigned();
            $table->foreign('to_city')->references('id')->on('cities');
            $table->boolean('status');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ttns');
    }
}
