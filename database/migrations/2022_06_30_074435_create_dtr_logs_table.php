<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //if exist (id num, date, time, type), ignore 
        Schema::create('dtr_logs', function (Blueprint $table) {
            $table->bigIncrements('dtr_log_id');
            $table->string('transaction_no')->comment('Generated per upload. If Some items exist it skip the item.');
            $table->string('employee_no')->nullable();
            //$table->string('name')->nullable();
            $table->string('year')->comment('yyyy');
            $table->string('month')->comment('mm');
            $table->string('day')->comment('dd');
            $table->string('hour')->comment('24 hr format.');
            $table->string('hour_12')->comment('12 hr format.');
            $table->string('minute')->comment('mm');
            $table->string('seconds')->comment('ss');
            $table->string('meridiem')->comment('AM/PM');
            $table->string('fifth_place')->nullable();
            $table->string('log_type_code')->comment('(0)-Check in. (1)-Check out. (2)-Break out. (3)-Break in)');
            $table->string('device')->nullable()->comment('G-Granding, V-Veterans');
            $table->string('uploaded_by')->comment('employee_no');
            $table->string('filename_original');
            $table->string('filename_uploaded');
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
        Schema::dropIfExists('dtr_logs');
    }
}
