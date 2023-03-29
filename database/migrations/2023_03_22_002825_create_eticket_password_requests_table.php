<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEticketPasswordRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eticket_password_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eticket_id');
            $table->string('new_password');
            $table->boolean('admin_approval')->default(false);
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
        Schema::dropIfExists('eticket_password_requests');
    }
}
