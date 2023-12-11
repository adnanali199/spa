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
        Schema::create('booking_payment', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('status')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('card_type')->nullable();
            $table->string('name_on_card')->nullable();
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
