<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_location', function (Blueprint $table) {
            $table->bigIncrements('employees_location_id');
            $table->string('employee_id')->nullable();
            $table->string('employee_no')->nullable();
            $table->string('pro_id')->nullable();
            $table->string('branchunit_id')->nullable();
            $table->string('lhiosection_id')->nullable();
            $table->string('express_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_location');
    }
}
