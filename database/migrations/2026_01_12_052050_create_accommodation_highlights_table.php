<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('accommodation_highlights', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g. Organic Breakfast
            $table->string('icon'); // e.g. fas fa-coffee
            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accommodation_highlights');
    }
};
