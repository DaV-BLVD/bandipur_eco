<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('who_we_are_contents', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Who We Are');
            $table->string('heading'); // The Soul of Bandipur...
            $table->text('description'); // The long paragraph

            // Feature 1
            $table->string('f1_icon')->default('fas fa-leaf');
            $table->string('f1_title')->default('Eco-First');
            $table->string('f1_desc')->default('Sustainable energy & plastic-free zones.');

            // Feature 2
            $table->string('f2_icon')->default('fas fa-gopuram');
            $table->string('f2_title')->default('Heritage');
            $table->string('f2_desc')->default('Authentic Newari brick & wood design.');

            // Feature 3
            $table->string('f3_icon')->default('fas fa-cloud-sun');
            $table->string('f3_title')->default('Serenity');
            $table->string('f3_desc')->default('Uninterrupted views of the Annapurnas.');

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('who_we_are_contents');
    }
};
