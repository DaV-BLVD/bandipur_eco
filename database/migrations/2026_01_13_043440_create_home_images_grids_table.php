<?php

// database/migrations/xxxx_xx_xx_create_home_images_grids_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_images_grids', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->integer('position'); // controls layout position
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_images_grids');
    }
};
