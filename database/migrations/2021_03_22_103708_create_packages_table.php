<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('packages')) return;
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->dateTime('date_registration');
            $table->dateTime('date_modification');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('clients');
            $table->integer('receiver_id')->unsigned();
            $table->foreign('receiver_id')->references('id')->on('clients');
            $table->boolean('payment');
            $table->integer('point_to')->unsigned();
            $table->foreign('point_to')->references('id')->on('points');
            $table->integer('point_from')->unsigned();
            $table->foreign('point_from')->references('id')->on('points');
            $table->double('user_price',10,2);
            $table->double('price',10,2);
            $table->double('width',10,2);
            $table->double('heigth',10,2);
            $table->double('lenght',10,2);
            $table->double('weight',10,2);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('returned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
