<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('map_locations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100); // Example: "Getting Here"
            $table->string('embed_url', 500); // Google Maps embed URL
            $table->text('description')->nullable(); // Optional text
            $table->string('primary_color', 7)->default('#0a7c15');
            $table->string('secondary_color', 7)->default('#6d6d18');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('map_locations');
    }
};
