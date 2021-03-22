<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('distances')) return;
        Schema::create('distances', function (Blueprint $table) {
            $table->integer('from_city')->unsigned();
            $table->foreign('from_city')->references('id')->on('cities');
            $table->integer('to_city')->unsigned();
            $table->foreign('to_city')->references('id')->on('cities');
            $table->integer('km');
            $table->primary(['from_city', 'to_city']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distances');
    }
}
