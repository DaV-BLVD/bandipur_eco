<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery_headers', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable(); // Bandipur Heritage
            $table->string('title'); // Visual Journey
            $table->text('subtitle')->nullable(); // Glimpses of life...
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_headers');
    }
};
