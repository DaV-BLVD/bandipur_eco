<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_twos', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->nullable(); // e.g. "Farm to Fork"
            $table->string('title')->nullable(); // e.g. "Flavors of the Hills"
            $table->text('description1')->nullable(); // first paragraph
            $table->text('description2')->nullable(); // second paragraph
            $table->string('image')->nullable(); // main image path

            // Features (icon, title, description)
            $table->string('feature1_icon')->nullable();
            $table->string('feature1_title')->nullable();
            $table->string('feature1_description')->nullable();

            $table->string('feature2_icon')->nullable();
            $table->string('feature2_title')->nullable();
            $table->string('feature2_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_twos');
    }
};
