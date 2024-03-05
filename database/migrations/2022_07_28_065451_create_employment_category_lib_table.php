<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentCategoryLibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_category_lib', function (Blueprint $table) {
            $table->id();
            //$table->string('category_code')->comment('Ex.: P-PAIMS, M-malasakit, C-PCARES, M-Medical Evaluator');
            $table->string('title')->unique();
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
        Schema::dropIfExists('employment_category_lib');
    }
}
