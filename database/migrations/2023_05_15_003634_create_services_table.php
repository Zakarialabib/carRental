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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('address');
            $table->double('map_lat', 10, 6);
            $table->double('map_lng', 10, 6);
            $table->boolean('is_featured')->default(false);
            $table->decimal('price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('min_day_before_booking')->default(1);
            $table->foreignId(Location::class)->constrained()->cascadeOnDelete();
            $table->foreignId(User::class)->constrained()->cascadeOnDelete();
            $table->bolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
