<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_quotes', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable(); // fa-solid fa-mountain-sun
            $table->string('subtitle');
            $table->text('quote');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_quotes');
    }
};
