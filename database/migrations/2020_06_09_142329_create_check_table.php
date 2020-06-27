<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('dv_id')->nullable();
            $table->string('act_id')->nullable();
            $table->string('check_id')->unique()->nullable();
            $table->string('time')->nullable();
            $table->string('checker')->nullable();
            $table->string('note')->nullable();
            $table->string('type_check')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check');
    }
}
