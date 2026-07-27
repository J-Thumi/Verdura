<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role'); // e.g., "Lead Landscape Architect", "Cabro & Paving Specialist"
            $table->string('specialty')->nullable(); // e.g., "Softscaping & Plant Care", "Civil Works & Cabro Laying"
            $table->text('bio')->nullable();
            $table->string('image_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->integer('sort_order')->default(0); // Control display order on page
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};