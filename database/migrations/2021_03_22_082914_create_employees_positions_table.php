<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('employees_positions')) return;
        Schema::create('employees_positions', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->integer('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->primary(['employee_id', 'position_id']);
            $table->date('date_change')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_positions');
    }
}
