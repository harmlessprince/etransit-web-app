<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTrusteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trustees', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracker_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('code')->nullable()->comment('Four digit code to view the session');
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
        Schema::dropIfExists('user_trustees');
    }
}
