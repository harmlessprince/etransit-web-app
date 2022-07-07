<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('username');
            $table->integer('experience');
            $table->string('email');
            $table->string('phone');
            $table->string('home_address');
            $table->string('license');
            $table->string('utility_or_nin');
            $table->boolean('convoy')->default(false);
            $table->boolean('light_commercial')->default(false);
            $table->boolean('commercial')->default(false);
            $table->boolean('trucks')->default(false);
            $table->boolean('industrial')->default(false);
            $table->string('notes')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->date('approvedAt')->nullable();
            $table->double('daily_rate')->nullable();
            $table->boolean('self_managed')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_drivers');
    }
}
