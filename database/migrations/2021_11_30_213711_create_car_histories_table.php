<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_plan_id');
            $table->enum('payment_status',['Unpaid','cash payment','Pending','paid'])->default('Unpaid');
            $table->enum('available_status',['Off Trip','On Trip'])->default('Off Trip')->comment('On trip when in use off trip when the user returned');
            $table->time('delayed_trip_in_minutes')->nullable()->comment('This start counting after 12 hours of delay and keeps increasing hourly');
            $table->double('amount_to_remit_after_delayed_trip')->nullable()->comment('This start counting after 12 hours of delay and keeps increasing hourly');
            $table->date('date')->comment('pickup date');
            $table->date('returnDate')->comment('expected return date');
            $table->time('returnTime')->comment('expected return time');
            $table->date('dropOffDate')->nullable()->comment('Date admin confirmed drop off');
            $table->time('drpOffTime')->nullable()->comment('Time admin confirmed drop off');
            $table->time('time')->comment('pick up time');
            $table->enum('isConfirmed',['True', 'False'])->default('False')->comment('confirmation is the ride is already book for the date');
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_plan_id')->references('id')->on('car_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_histories');
    }
}
