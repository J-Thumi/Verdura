<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pot_images_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pot_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pot_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->string('angle_label')->nullable()->comment('Front, Side, Top, Context/Lifestyle');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pot_images');
    }
};