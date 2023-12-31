<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('pool_id');
            $table->string('customer_id');
            $table->string('booking_date');
            $table->string('time');
            $table->string('end_date');
            $table->string('instructions')->nullable();
            $table->string('status')->nullable();
            $table->integer('approved_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         //
         Schema::dropIfExists('bookings');
    }
};
