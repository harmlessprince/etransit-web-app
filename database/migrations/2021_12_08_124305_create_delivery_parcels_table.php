<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_parcels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parcel_id');
            $table->string('sender_name')->nullable();
            $table->string('sender_phone_number')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();

            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone_number')->nullable();
            $table->unsignedBigInteger('delivery_city_id')->nullable();

            $table->unsignedBigInteger('weight');
            $table->unsignedBigInteger('height');
            $table->unsignedBigInteger('length');
            $table->unsignedBigInteger('width');
            $table->longText('notes')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parcel_id')->references('id')->on('parcels')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_parcels');
    }
}
