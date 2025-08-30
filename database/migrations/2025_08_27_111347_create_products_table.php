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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('size')->nullable()->index();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('use_case')->nullable()->index();
            $table->text('description')->nullable();
            $table->json('caracteristics')->nullable();  // store structured attributes as JSON
            $table->string('reference')->nullable()->index();

             $table->decimal('price1', 12, 2)->nullable()->index();
            $table->decimal('price2', 12, 2)->nullable()->index();
            $table->integer('stock')->default(0)->index();
            $table->unsignedTinyInteger('discount')->default(0); // 0..100 (%)
            $table->boolean('is_new')->default(false)->index();

            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();

            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();

            $table->index(['brand_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
