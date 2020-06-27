<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mainten_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('repair_responsible')->nullable();
            $table->string('information')->nullable();
            $table->string('note')->nullable();
            $table->string('dv_id')->nullable();
            $table->integer('status')->nullable();
            $table->datetime('schedule_date')->nullable();
            $table->datetime('proceed_date')->nullable();
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
        Schema::dropIfExists('mainten_schedule');
    }
}
