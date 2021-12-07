<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boat_trips', function (Blueprint $table) {
            $table->id();
            $table->string('cruise_name');
            $table->double('min_amount');
            $table->double('max_amount');
            $table->time('departure_time');
            $table->datetime('departure_date');
            $table->longText('description');
            $table->unsignedBigInteger('duration');
            $table->unsignedBigInteger('boat_id');
            $table->unsignedBigInteger('cruise_destination_id');
            $table->timestamps();
            $table->foreign('boat_id')->references('id')->on('boats')->onDelete('cascade');
            $table->foreign('cruise_destination_id')->references('id')->on('cruise_destinations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boat_trips');
    }
}
