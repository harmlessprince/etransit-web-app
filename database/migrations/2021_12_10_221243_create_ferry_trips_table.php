<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFerryTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferry_trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ferry_id');
            $table->unsignedBigInteger('ferry_pick_up_id');
            $table->unsignedBigInteger('ferry_destination_id');
            $table->double('amount');
            $table->string('trip_duration');
            $table->longText('trip_description')->nullable();
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
        Schema::dropIfExists('ferry_trips');
    }
}
