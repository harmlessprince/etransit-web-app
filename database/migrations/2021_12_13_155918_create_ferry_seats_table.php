<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFerrySeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferry_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ferry_id');
            $table->string('coach_type');
            $table->unsignedBigInteger('coach_number');
            $table->unsignedBigInteger('user_id')->nullable()->comment('the user trying to book');
            $table->unsignedBigInteger('booked_status')->default(0)->comment('0 = false , 1 = selected  , 2 = booked');
            $table->timestamps();

            $table->foreign('ferry_id')->references('id')->on('ferries')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ferry_seats');
    }
}
