<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTtnPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('ttn_packages')) return;
        Schema::create('ttn_packages', function (Blueprint $table) {
            $table->integer('ttn_id')->unsigned();
            $table->foreign('ttn_id')->references('id')->on('ttns');
            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->primary(['ttn_id', 'package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ttn_packages');
    }
}
