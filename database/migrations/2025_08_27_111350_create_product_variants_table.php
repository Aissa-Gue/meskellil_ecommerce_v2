<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();

            $table->string('color', 100)->nullable()->index();
            $table->string('shape', 100)->nullable()->index();
            $table->string('size', 100)->nullable()->index();
            $table->string('taste', 100)->nullable()->index();

            $table->decimal('price1', 12, 2)->nullable()->index();
            $table->decimal('price2', 12, 2)->nullable()->index();

            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();

            $table->unique(['product_id', 'color', 'shape', 'size', 'taste'], 'product_variants_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
