<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestinationColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tracking_records', function (Blueprint $table) {
            if (!Schema::hasColumn('tracking_records', 'destination_longitude')) {
                $table->string('destination_longitude')->nullable();
            }
            if (!Schema::hasColumn('tracking_records', 'destination_latitude')) {
                $table->string('destination_latitude')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracking_records', function (Blueprint $table) {
            //
        });
    }
}
