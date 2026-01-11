<?php

// database/migrations/2026_01_11_000000_create_important_infos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('important_infos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., "Check-in & Check-out"
            $table->string('icon')->nullable(); // FontAwesome or Heroicon
            $table->json('items'); // array of bullet points
            $table->boolean('status')->default(true); // active/inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('important_infos');
    }
};
