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
            $table->string('car_name');
            $table->string('car_registration');
            $table->enum('transmission', ['automatic', 'manual']);
            $table->string('model_year');
            $table->unsignedBigInteger('car_type_id');
            $table->unsignedBigInteger('car_class_id');
            $table->unsignedBigInteger('service_id');
            $table->integer('capacity')->comment('the seat capacity');
            $table->string('image_url')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('functional')->default(1)->comment('0 = false , 1 = true');
            $table->unsignedBigInteger('air_conditioning')->default(1)->comment('0 = false , 1 = true');

            $table->enum('booked_status',['true' , 'false'])->default('false');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('car_class_id')->references('id')->on('car_classes')->onDelete('cascade');
            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('cascade');
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
