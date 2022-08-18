<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_records', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracker_id');
            $table->string('location');
            $table->string('longitude');
            $table->string('latitude');
            $table->enum('notification_triger',['active','inactive'])->default('inactive')->comment('active is true , inactive is false');
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
        Schema::dropIfExists('tracking_records');
    }
}
