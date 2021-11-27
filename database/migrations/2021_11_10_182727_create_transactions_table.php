<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('trx_ref')->nullable();
            $table->double('amount',);
            $table->enum('status',['Successful','Pending','Cash payment','Likely Fraud']);
            $table->unsignedBigInteger('service_id');
            $table->enum('transaction_type',['cash','online'])->default('online');
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('passenger_count')->nullable();
            $table->enum('isConfirmed',['True', 'False'])->default('False');
            $table->string('description');
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
        Schema::dropIfExists('transactions');
    }
}
