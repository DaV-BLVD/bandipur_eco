<?php

// database/migrations/xxxx_xx_xx_create_home_features_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_features', function (Blueprint $table) {
            $table->id();
            $table->string('time'); // 06:00 AM
            $table->string('title'); // Sunrise Ritual
            $table->text('description'); // Description text
            $table->integer('order'); // Display order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_features');
    }
};
