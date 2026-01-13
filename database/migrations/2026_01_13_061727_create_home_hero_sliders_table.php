<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('badge_text')->nullable(); // e.g. "Welcome to Paradise"
            $table->string('title_prefix')->nullable(); // e.g. "Our"
            $table->string('title_highlight')->nullable(); // e.g. "Story" (Colored part)
            $table->string('title_suffix')->nullable(); // e.g. "Begins With Nature"
            $table->text('description')->nullable();
            $table->string('button_text')->default('Discover More');
            $table->string('button_link')->default('#');
            $table->string('color_hex')->default('#6d6d18'); // The theme color for badge/span/button
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_hero_sliders');
    }
};
