<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_highlight_two_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_highlight_two_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('text');
            $table->integer('order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_highlight_two_items');
    }
};
