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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('map_lat', 10, 7);
            $table->decimal('map_lng', 10, 7);
            $table->integer('map_zoom')->default(15);
            $table->strng('image')->nullable();
            $table->strng('banner_image')->nullable();
            $table->strng('parent_id')->nullable();
            $table->timestamps();
            $table->bolean('status')->default(true);
            $table->foreignId(User::class)->constrained()->cascadeOnDelete();
            $table->foreignId(Car::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
