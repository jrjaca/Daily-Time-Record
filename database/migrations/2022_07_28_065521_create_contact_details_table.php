<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();	
            $table->string('employee_no')->nullable();	
            $table->string('telephone_no')->nullable();	
            $table->string('mobile_no')->nullable();	
            $table->string('personal_email')->nullable();	
            $table->string('corporate_email')->nullable();	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_details');
    }
}
