<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteFareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_fare', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('train_location_id');
            $table->unsignedBigInteger('train_stop_id');
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
        Schema::dropIfExists('route_fare');
    }
}
