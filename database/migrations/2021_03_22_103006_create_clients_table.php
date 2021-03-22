<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('clients')) return;
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',55);
            $table->char('phone',55);
            $table->integer('point_default_id')->unsigned();
            $table->foreign('point_default_id')->references('id')->on('points');
            $table->char('username',55);
            $table->char('email',255);
            $table->char('password', 255);
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}