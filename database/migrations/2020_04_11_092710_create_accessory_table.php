<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('acc_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('size')->nullable();
            $table->integer('provider_id')->nullable();
            $table->string('type')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('used')->nullable();
            $table->integer('broken')->nullable();
            $table->integer('status')->nullable();
            $table->date('import_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('factory')->nullable();
            $table->string('produce_date')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
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
        Schema::dropIfExists('accessory');
    }
}
