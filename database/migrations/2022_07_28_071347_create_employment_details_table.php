<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_details', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('employee_no')->nullable();  
            $table->string('item_number')->nullable();	
            $table->string('employment_type_id')->nullable();	
            $table->string('employment_category_id')->nullable();	
            $table->string('salary_grade')->nullable();	
            $table->string('date_hired')->nullable();	
            $table->string('date_resigned')->nullable();	
            $table->string('position_id')->nullable();
            $table->string('eligibility')->nullable();	
            $table->text('remarks')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment_details');
    }
}
