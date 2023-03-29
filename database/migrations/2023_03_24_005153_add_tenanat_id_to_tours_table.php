<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenanatIdToToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });
    }
}
