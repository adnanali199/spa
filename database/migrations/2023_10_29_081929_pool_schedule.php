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
        Schema::create('pool_schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('pool_id');
            $table->string('date_available')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->boolean('is_holiday')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         //
         Schema::dropIfExists('pool_schedule');
    }
};
