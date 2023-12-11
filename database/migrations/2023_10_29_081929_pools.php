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
        Schema::create('pools', function (Blueprint $table) {
            $table->id();
            $table->string('pool_name')->unique;
            $table->string('short_name')->unique();
            $table->integer('owner_id');
            $table->string('logo')->nullable();
            $table->longText('features')->nullable();
            $table->longText('rules')->nullable();
            $table->float('price')->nullable()->default(0);
            $table->float('holiday_price')->nullable()->default(0);
            $table->float('length')->nullable()->default(0);
            $table->float('width')->nullable()->default(0);
            $table->float('land_length')->nullable()->default(0);
            $table->float('land_width')->nullable()->default(0);
            $table->integer('no_of_rooms')->nullable()->default(0);
            $table->string('city')->nullable()->default('');
            $table->string('state')->nullable()->default('');
            $table->string('address')->nullable()->default('');
            $table->string('slot_id')->nullable();
            $table->string('end_time')->nullable();
            $table->boolean('status')->nullable()->default(false);
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
         Schema::dropIfExists('pools');
    }
};
