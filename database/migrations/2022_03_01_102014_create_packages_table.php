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
            $table->id();
            $table->foreignId("sender_id");
            $table->foreignId("recipient_id")->nullable();
            $table->foreignId('address_id');
            $table->text('notes')->nullable(true);
            $table->dateTime('sent_date')->nullable();
            $table->dateTime('delivered_date')->nullable();
            $table->string('status');
            $table->foreign('status')->references('status')->on('statuses');

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
