<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddOnsiteCustomersidToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('onsite_customer_id')->nullable()->comment('');
            $table->foreign('onsite_customer_id')->references('id')->on('onsite_customers')->onDelete('restrict');
            $table->unsignedBigInteger('user_id')->nullable()->comment('user that used his / her account to book')->change();
            //$table->enum('transaction_type',['cash payment','online','onsite'])->default('online')->change();
            DB::statement("ALTER TABLE `transactions` MODIFY COLUMN `transaction_type` ENUM('cash payment','online','onsite')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('onsite_customer_id');
            $table->dropColumn('onsite_customer_id');
            //$table->enum('transaction_type',['cash payment','online'])->default('online')->change();
        });
    }
}
