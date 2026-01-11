<?php

// database/migrations/2026_01_11_000000_create_accommodation_headers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('accommodation_headers', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text');
            $table->string('title');
            $table->text('description');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accommodation_headers');
    }
};
