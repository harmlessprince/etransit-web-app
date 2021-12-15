<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFerryPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferry_passengers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ferry_trip_id');
            $table->unsignedBigInteger('user_id')->comment('user that used his / her account to book');
            $table->unsignedBigInteger('ferry_seat_tracker_id');
            $table->string('full_name');
            $table->string('gender');
            $table->string('passenger_age_range')->comment('adult or children');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('ferry_trip_id')->references('id')->on('ferry_trips')->onDelete('cascade');
//            $table->foreign('ferry_seat_tracker_id')->references('id')->on('ferry_seat_trackers')->onDelete('cascade');
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
        Schema::dropIfExists('ferry_passengers');
    }
}
