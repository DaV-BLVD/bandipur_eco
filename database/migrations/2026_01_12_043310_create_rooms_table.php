<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., Single, Couple Room
            $table->string('category'); // single, double, others (for filtering)
            $table->decimal('price', 8, 2);
            $table->string('badge_text')->nullable(); // e.g., Mountain View
            $table->string('image');
            $table->text('description');

            // Feature details
            $table->string('occupancy'); // e.g., solo, 2 person
            $table->string('bed_type'); // e.g., king, twin
            $table->boolean('has_wifi')->default(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
