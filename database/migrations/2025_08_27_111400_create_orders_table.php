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
        Schema::create('orders', function (Blueprint $table) {
           $table->id();

            // Nullable client_id for guest orders
            $table->foreignId('client_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable()->index();
            $table->unsignedSmallInteger('wilaya_id')->nullable()->index();

            $table->enum('payment_status', ['full_paid', 'partial_paid', 'pending'])->default('pending')->index();
            $table->enum('payment_method', ['cash', 'ccp', 'bank_transfer'])->default('cash')->index();
            $table->boolean('is_verified')->default(false)->index();
            $table->enum('order_status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'canceled'])
                ->default('pending')->index();

            $table->decimal('total_price', 12, 2)->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
