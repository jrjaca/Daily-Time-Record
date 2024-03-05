<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocLhiosectionLibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loc_lhiosection_lib', function (Blueprint $table) {
            $table->id('lhiosection_id');
            $table->string('branchunit_id');
            $table->string('title')->comment('LHIOS & Section under the Branch');
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
        Schema::dropIfExists('loc_lhiosection_lib');
    }
}
