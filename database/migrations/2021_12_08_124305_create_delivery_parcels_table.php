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

            $table->string('sender_name');
            $table->string('sender_phone_number');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');

            $table->string('receiver_name');
            $table->string('receiver_phone_number');
            $table->unsignedBigInteger('delivery_state_id');
            $table->unsignedBigInteger('delivery_city_id');

            $table->unsignedBigInteger('weight');
            $table->unsignedBigInteger('height');
            $table->unsignedBigInteger('length');
            $table->unsignedBigInteger('width');

            $table->double('amount');
            $table->unsignedBigInteger('quantity');
            $table->longText('notes')->nullable();

            $table->longText('receiver_landmark')->nullable();
            $table->longText('sender_landmark')->nullable();

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
