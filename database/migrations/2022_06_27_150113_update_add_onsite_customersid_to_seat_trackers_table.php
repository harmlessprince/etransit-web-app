<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddOnsiteCustomersidToSeatTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seat_trackers', function (Blueprint $table) {
            $table->unsignedBigInteger('onsite_customer_id')->nullable()->comment('');
            $table->foreign('onsite_customer_id')->references('id')->on('onsite_customers')->onDelete('restrict');
            $table->unsignedBigInteger('tenant_id')->nullable();
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
        Schema::table('seat_trackers', function (Blueprint $table) {
            $table->dropForeign('onsite_customer_id');
            $table->dropColumn('onsite_customer_id');
            $table->dropColumn('tenant_id');

        });
    }
}
