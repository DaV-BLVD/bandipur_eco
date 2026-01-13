<?php

// database/migrations/xxxx_xx_xx_create_home_taste_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_taste_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_taste_id')->constrained()->cascadeOnDelete();
            $table->string('text');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_taste_items');
    }
};
