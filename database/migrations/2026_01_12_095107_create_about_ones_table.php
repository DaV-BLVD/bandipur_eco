<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_ones', function (Blueprint $table) {
            $table->id();
            $table->string('since')->nullable(); // "Since 1998"
            $table->string('title')->nullable(); // "The Estate"
            $table->string('subtitle')->nullable(); // "in the Clouds"
            $table->text('description')->nullable(); // Paragraph
            $table->integer('suites')->nullable(); // Number of suites
            $table->integer('acres')->nullable(); // Size in acres
            $table->string('views')->nullable(); // Views info e.g. "360°"
            $table->string('image')->nullable(); // Image path
            $table->text('quote')->nullable(); // Overlay quote
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_ones');
    }
};
