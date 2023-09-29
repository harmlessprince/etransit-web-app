<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->integer("bus_year");
            $table->string("bus_colour");
            $table->tinyInteger("bus_available_seats");
            $table->text("bus_pictures");
            $table->text("bus_proof_of_ownership");
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
            $table->dropColumn("bus_year");
            $table->dropColumn("bus_colour");
            $table->dropColumn("bus_available_seats");
            $table->dropColumn("bus_pictures");
            $table->dropColumn("bus_proof_of_ownership");
        });
    }
}
