<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_action', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('act_id')->nullable();
            $table->string('dv_id')->nullable();
            $table->string('scheduleAct')->nullable();
            $table->string('scheduleTime')->nullable();
            $table->string('startDate')->nullable();
            $table->string('note')->nullable();            
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
        Schema::dropIfExists('schedule_action');
    }
}
