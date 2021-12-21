<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('train_location_id');
            $table->string('stop_name');
            $table->unsignedBigInteger('train_class_id');
            $table->double('amount_adult');
            $table->double('amount_child');
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
        Schema::dropIfExists('train_stops');
    }
}
