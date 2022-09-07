<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->longText('purpose_of_movement')->nullable();
            $table->longText('destination_description')->nullable();
            $table->enum('status', ['active','inactive'])->default('inactive');
            $table->enum('tracking_type',['standalone','bus_booking','car_hiring','train_service','ferry_service','boat_service','tour_service','parcel_service']);
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable()->comment('bus tracking');
            $table->unsignedBigInteger('car_history_id')->nullable()->comment('add id to track car hiring booking');
            $table->unsignedBigInteger('boat_trip_id')->nullable()->comment('add id to track boat booking');
            $table->unsignedBigInteger('delivery_parcel_id')->nullable()->comment('id for parcel delivery');
            $table->unsignedBigInteger('ferry_trip_id')->nullable()->comment('set the id of the ferry trip id');
            $table->unsignedBigInteger('train_schedule_id')->nullable()->comment('id for train schedule');
            $table->unsignedBigInteger('tour_id')->nullable()->comment('Id Tour packages');
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
        Schema::dropIfExists('trackers');
    }
}
