<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainSeatTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_seat_trackers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('train_seat_id');
            $table->unsignedBigInteger('train_id');
            $table->unsignedBigInteger('train_schedule_id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('the user trying to book');
            $table->unsignedBigInteger('booked_status')->default(0)->comment('0 = false , 1 = selected  , 2 = booked');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('train_schedule_id')->references('id')->on('train_schedules')->onDelete('cascade');
            $table->foreign('train_seat_id')->references('id')->on('train_seats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('train_seat_trackers');
    }
}
