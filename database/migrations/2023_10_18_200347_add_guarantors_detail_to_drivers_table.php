<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuarantorsDetailToDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('nin')->nullable()->change();
            $table->text('license')->nullable()->change();
            $table->string('guarantor_name')->nullable();
            $table->string('guarantor_phone_number')->nullable();
            $table->text('guarantor_picture')->nullable();
            $table->text('picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driverss', function (Blueprint $table) {
            //
        });
    }
}
