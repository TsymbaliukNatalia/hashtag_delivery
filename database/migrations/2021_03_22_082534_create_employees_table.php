<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('employees')) return;
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',55);
            $table->date('birth_date')->nullable();
            $table->char('phone',55);
            $table->char('adress',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
