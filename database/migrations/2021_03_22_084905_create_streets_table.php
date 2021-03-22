<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('streets')) return;
        Schema::create('streets', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',55);
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streets');
    }
}
