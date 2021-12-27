<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('trx_ref')->nullable();
            $table->double('amount',);
            $table->enum('status',['Successful','Pending','Likely Fraud']);
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('car_history_id')->nullable()->comment('ad id to track car hiring booking');
            $table->unsignedBigInteger('boat_trip_id')->nullable()->comment('ad id to track boat booking');
            $table->unsignedBigInteger('delivery_parcel_id')->nullable()->comment('set the id of the parcel that was paid for');
            $table->unsignedBigInteger('ferry_trip_id')->nullable()->comment('set the id of the ferry trip id');
            $table->enum('transaction_type',['cash payment','online'])->default('online');
            $table->unsignedBigInteger('schedule_id')->nullable()->comment('schedule id is for bus ticketing');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tour_id')->nullable()->comment('for Tour packages payment');
            $table->unsignedBigInteger('train_schedule_id')->nullable()->comment('for train packages payment');
            $table->unsignedBigInteger('passenger_count')->nullable()->comment('passenger count for bus booking');
            $table->enum('isConfirmed',['True', 'False'])->default('False');
            $table->string('description');
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('car_history_id')->references('id')->on('car_histories')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('boat_trip_id')->references('id')->on('boat_trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
