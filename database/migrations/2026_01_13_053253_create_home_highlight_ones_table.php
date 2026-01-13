<?php

// database/migrations/xxxx_xx_xx_create_home_highlight_ones_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_highlight_ones', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('percentage'); // e.g. 85%
            $table->string('text'); // Ingredients from our own garden
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_highlight_ones');
    }
};
