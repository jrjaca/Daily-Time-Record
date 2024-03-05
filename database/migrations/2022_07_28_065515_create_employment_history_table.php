<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_history', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('employee_no')->nullable();
            $table->string('date_hired')->nullable();	
            $table->string('date_resigned')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment_history');
    }
}
