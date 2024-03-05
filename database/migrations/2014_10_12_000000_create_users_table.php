<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('avatar')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('employee_no')->unique()->comment('As username. Unique ID of PHIC Employees ID.');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('suffix_name')->nullable();
            $table->string('pro_id')->nullable();
            $table->string('branchunit_id')->nullable();
            $table->string('lhiosection_id')->nullable();
            $table->string('express_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('activated')->default(0)->comment('Upon approval of administrator, after registration');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
