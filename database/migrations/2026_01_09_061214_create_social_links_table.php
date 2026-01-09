<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Facebook, Instagram, etc
            $table->string('icon'); // FontAwesome class, e.g. fab fa-facebook-f
            $table->string('url'); // Link to social profile
            $table->string('color')->default('#0a7c15'); // bg color
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};
