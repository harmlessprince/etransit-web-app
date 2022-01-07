<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_plans', function (Blueprint $table) {
            $table->id();
            $table->enum('plan',['Daily Rentals','North Central','South West','South South','South East']);
            $table->double('amount');
            $table->double('extra_hour')->nullable();
            $table->unsignedBigInteger('car_id');
            $table->timestamps();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_plans');
    }
}
