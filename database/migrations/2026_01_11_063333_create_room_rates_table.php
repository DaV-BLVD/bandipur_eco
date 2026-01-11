<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('room_rates', function (Blueprint $table) {
            $table->id();

            $table->string('badge')->nullable(); // Standard, Couple, Premium
            $table->string('title'); // Mountain View Suite
            $table->string('tag')->nullable(); // Most Popular, Premium
            $table->string('image'); // image path

            $table->integer('price'); // 120 / 1950 / 280
            $table->string('currency')->default('Rs'); // Rs / $
            $table->integer('rating')->default(5); // 1–5
            $table->integer('reviews')->default(0);

            $table->json('features')->nullable(); // room features
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_rates');
    }
};
