<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pots_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->text('description')->nullable();
            
            // Physical Specifications
            $table->string('material')->comment('Terracotta, Ceramic, Concrete, Fiberglass, etc.');
            $table->string('finish')->nullable()->comment('Matte, Glazed, Textured, Smooth');
            $table->decimal('height_cm', 8, 2)->nullable();
            $table->decimal('diameter_cm', 8, 2)->nullable();
            $table->decimal('capacity_liters', 8, 2)->nullable();
            $table->decimal('weight_kg', 8, 2)->nullable();
            $table->string('color')->nullable();
            $table->boolean('has_drainage_holes')->default(true);
            $table->enum('usage', ['indoor', 'outdoor', 'both'])->default('both');
            
            // Commercial details
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // 3D Model file asset (GLTF/GLB file for interactive 3D rendering)
            $table->string('model_3d_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pots');
    }
};