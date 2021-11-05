<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('trip_type_id')->comment('One way or Round Trip - ID');
            $table->string('number_of_passengers');
            $table->timestamps();

             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
//            $table->foreign('trip_type_id')->references('id')->on('trip_type')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
