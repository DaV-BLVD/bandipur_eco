<?php

// database/migrations/xxxx_xx_xx_create_rates_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rates_tables', function (Blueprint $table) {
            $table->id();
            $table->string('room_type');
            $table->string('single_price')->nullable();
            $table->string('double_price')->nullable();
            $table->string('extra_bed')->nullable();
            $table->json('inclusions')->nullable();
            $table->string('currency')->default('USD');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rates_tables');
    }
};
