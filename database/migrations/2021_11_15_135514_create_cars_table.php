<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_type');
            $table->string('car_class');
            $table->double('daily_rentals');
            $table->double('extra_hour');
            $table->double('sw_fare')->comment('sw region');
            $table->double('ss_fare')->comment('ss region');
            $table->double('se_fare')->comment('se region');
            $table->double('nc_fare')->comment('nc region');
            $table->string('image_url')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('functional')->default(1)->comment('0 = false , 1 = true');
            $table->unsignedBigInteger('air_conditioning')->default(1)->comment('0 = false , 1 = true');
            $table->enum('booked_status',['true' , 'false'])->default('false');
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
        Schema::dropIfExists('cars');
    }
}
