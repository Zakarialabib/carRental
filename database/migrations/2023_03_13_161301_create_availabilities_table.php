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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->date('start_date');
            $table->time('pickup_time');
            $table->date('end_date');
            $table->time('dropoff_time');
            $table->string('description')->nullable();
            $table->foreignId(Location::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId(User::class)->constrained()->cascadeOnDelete();
            $table->foreignId(Car::class)->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
