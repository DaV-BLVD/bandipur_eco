<?php

// database/migrations/2026_01_11_000000_create_accommodation_heros_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('accommodation_heros', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // hero image
            $table->string('alt_text')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accommodation_heros');
    }
};
