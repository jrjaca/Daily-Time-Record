<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLogsPipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_logs_pips', function (Blueprint $table) {
            $table->bigIncrements('dtr_log_pips_id');
            //$table->integer('dtr_log_id')->comment('dtr_log_id from dtr_logs table, separated by |');
            //$table->string('transaction_no')->comment('Generated per upload. If Some items exist it skip the item.');
            $table->string('employee_no')->nullable();
            //$table->string('name')->nullable();
            $table->string('year')->comment('yyyy');
            $table->string('month')->comment('mm');
            $table->string('day')->comment('dd');
            $table->string('time_logs')->comment('AM/PM, OT In/Out, separated by |. For PIPS use');
            $table->string('time_logs_dtr')->comment('AM/PM, OT In/Out, separated by |. For DTR use');
            $table->integer('uploaded_by')->comment('employee_no');
            $table->integer('modified_by')->nullable()->comment('employee_no');
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
        Schema::dropIfExists('dtr_logs_pips');
    }
}
