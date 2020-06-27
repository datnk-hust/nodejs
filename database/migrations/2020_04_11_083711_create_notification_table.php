<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('req_content')->nullable();
            $table->string('res_content')->nullable();
            $table->integer('dept_now')->nullable();
            $table->integer('dept_next')->nullable();
            $table->string('dv_id')->nullable();
            $table->integer('status')->nullable();
            $table->string('annunciator_id')->nullable();
            $table->datetime('req_date')->nullable();
            $table->datetime('res_date')->nullable();
            $table->string('receiver')->nullable();
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
        Schema::dropIfExists('notification');
    }
}
