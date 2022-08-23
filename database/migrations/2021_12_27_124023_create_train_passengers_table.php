<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_passengers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('train_schedule_id');
            $table->unsignedBigInteger('user_id')->comment('user that used his / her account to book');
            $table->unsignedBigInteger('train_seat_tracker_id');
            $table->string('full_name');
            $table->string('gender');
            $table->string('passenger_age_range')->comment('adult or children');
            $table->string('next_of_kin_full_name');
            $table->string('next_of_kin_phone_number');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('train_schedule_id')->references('id')->on('train_schedules')->onDelete('cascade');
            $table->foreign('train_seat_tracker_id')->references('id')->on('train_seat_trackers')->onDelete('cascade');
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
        Schema::dropIfExists('train_passengers');
    }
}
