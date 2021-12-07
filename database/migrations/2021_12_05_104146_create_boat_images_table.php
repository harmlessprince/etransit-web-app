<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boat_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->string('path');
            $table->timestamps();
            $table->foreign('boat_id')->references('id')->on('boats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boat_images');
    }
}
