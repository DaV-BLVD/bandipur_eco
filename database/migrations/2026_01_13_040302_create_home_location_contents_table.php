<?php

// database/migrations/xxxx_xx_xx_create_home_location_contents_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_location_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('description');

            $table->string('car_label')->default('BY CAR');
            $table->text('car_text');

            $table->string('pickup_label')->default('PICKUP');
            $table->text('pickup_text');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_location_contents');
    }
};
