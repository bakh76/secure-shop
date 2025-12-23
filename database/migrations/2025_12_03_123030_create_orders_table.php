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
            
            // Link to User
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Order Status & Details
            $table->string('status')->default('pending'); // processing, shipped, etc.
            $table->decimal('total', 10, 2);
            
            // Payment Info
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->text('shipping_address')->nullable();

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