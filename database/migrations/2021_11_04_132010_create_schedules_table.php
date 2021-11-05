<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('terminal_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('pickup_id')->comment("starting point");
            $table->unsignedBigInteger('destination_id')->comment("destination point");
            $table->double('fare_adult')->comment("Transportation fare for adult");;
            $table->double('fare_children')->nullable()->comment("Set Transportation fare for children if any");
            $table->date('departure_date');
            $table->date('return_date');
            $table->time('departure_time');
            $table->time('return_time');
            $table->unsignedBigInteger('seats_available')->comment("Numbers of seat available");;
            $table->timestamps();

            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
