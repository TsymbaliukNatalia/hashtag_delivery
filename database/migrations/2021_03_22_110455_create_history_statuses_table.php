<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('history_statuses')) return;
        Schema::create('history_statuses', function (Blueprint $table) {
            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->dateTime('date_change');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->primary(['package_id', 'date_change']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_statuses');
    }
}
