<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_type');
            $table->string('bus_model');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('bus_registration')->unique();
            $table->unsignedBigInteger('air_conditioning')->default(1)->comment("False = 0, True = 1");;
            $table->string('wheels')->nullable()->comment("Number of tyres");;
            $table->string('seater')->comment("how many seater");;
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
        Schema::dropIfExists('buses');
    }
}
