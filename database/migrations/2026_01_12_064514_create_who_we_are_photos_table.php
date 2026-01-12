<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('who_we_are_photos', function (Blueprint $table) {
            $table->id();
            $table->string('image_primary'); // first image
            $table->string('title')->nullable(); // optional title
            $table->string('subtitle')->nullable(); // optional subtitle
            $table->string('image_secondary'); // second image
            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('who_we_are_photos');
    }
};
