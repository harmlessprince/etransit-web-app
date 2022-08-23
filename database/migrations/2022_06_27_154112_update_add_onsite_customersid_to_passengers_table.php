<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddOnsiteCustomersidToPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->unsignedBigInteger('onsite_customer_id')->nullable()->comment('used in lieu of userid when a physical booking is made');
            $table->foreign('onsite_customer_id')->references('id')->on('onsite_customers')->onDelete('restrict');
            $table->unsignedBigInteger('user_id')->nullable()->comment('user that used his / her account to book')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->dropForeign('onsite_customer_id');
            $table->dropColumn('onsite_customer_id');

        });
    }
}
