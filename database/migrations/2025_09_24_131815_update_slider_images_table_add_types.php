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
        Schema::table('slider_images', function (Blueprint $table) {
            // Add new columns
            $table->string('type')->default('slider')->after('id');
            $table->integer('resolution_width')->nullable()->after('image_url');
            $table->integer('resolution_height')->nullable()->after('resolution_width');
            $table->integer('max_items')->default(1)->after('sort_order');
            
            // Drop old columns
            $table->dropColumn(['title', 'subtitle']);
            
            // Add indexes
            $table->index('type');
            $table->index(['type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slider_images', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex(['type']);
            $table->dropIndex(['type', 'is_active']);
            
            // Drop new columns
            $table->dropColumn(['type', 'resolution_width', 'resolution_height', 'max_items']);
            
            // Add back old columns
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
        });
    }
};
