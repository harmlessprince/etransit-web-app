<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_seats', function (Blueprint $table) {
            $table->id();
            $table->string('coach_type');
            $table->unsignedBigInteger('coach_number');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('train_id');
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
        Schema::dropIfExists('train_seats');
    }
}
