<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeColoumnNullableOnBuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->integer("bus_year")->nullable()->change();
            $table->string("bus_colour")->nullable()->change();
            $table->smallInteger("bus_available_seats")->nullable()->change();
            $table->text("bus_pictures")->change()->nullable();
            $table->text("bus_proof_of_ownership")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buses', function (Blueprint $table) {
            //
        });
    }
}
