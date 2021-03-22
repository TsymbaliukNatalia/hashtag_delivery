<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('points')) return;
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',55);
            $table->date('date_open');
            $table->date('date_close')->nullable();
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->char('adress',255);
            $table->char('phone',55);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
