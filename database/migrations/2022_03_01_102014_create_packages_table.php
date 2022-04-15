<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId("sender_id");
            $table->foreignId("recipient_id");
            $table->foreignId('status_id');
            $table->text('notes')->nullable(true);
            $table->dateTime('sent_date')->nullable();
            $table->dateTime('delivered_date')->nullable();
            $table->string('transporter')->nullable();
            $table->date('pickup_date')->nullable();
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
        Schema::dropIfExists('packages');
    }
};
