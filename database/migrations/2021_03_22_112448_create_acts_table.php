<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('acts')) return;
        Schema::create('acts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ttn_id')->unsigned();
            $table->foreign('ttn_id')->references('id')->on('ttns');
            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packeges');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acts');
    }
}
