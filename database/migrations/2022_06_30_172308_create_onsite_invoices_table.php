<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnsiteInvoicesTable extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onsite_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('onsite_customer_id');
            $table->unsignedBigInteger('transaction_id');
            $table->integer('adultCount');
            $table->integer('childrenCount')->nullable();
            $table->integer('tripType')->commment('1 for oneway, 2 for roundtrip');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('restrict');
            $table->foreign('onsite_customer_id')->references('id')->on('onsite_customers')->onDelete('restrict');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onsite_invoices');
    }
}


