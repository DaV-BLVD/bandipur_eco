<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // fa-phone-alt, fa-envelope, fa-map-marker-alt
            $table->string('title'); // Call Us, Email Us
            $table->string('subtitle')->nullable();
            $table->string('value'); // phone number / email / address
            $table->string('link')->nullable(); // tel:, mailto:, map link
            $table->string('theme_color')->default('#0a7c15');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
