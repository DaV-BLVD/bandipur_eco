<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rate_headers', function (Blueprint $table) {
            $table->id();

            // Text content
            $table->string('badge_text')->nullable(); // Luxury Resort
            $table->string('title'); // Our Rates
            $table->string('highlight_text')->nullable(); // Rates
            $table->text('description')->nullable();

            // Stats
            $table->integer('room_types')->default(0); // 5
            $table->integer('off_season_discount')->default(0); // 30
            $table->integer('service_hours')->default(0); // 24

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rate_headers');
    }
};
