<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled']);
            $table->foreignId('transaction_id')->nullable();
            $table->timestamps();
        });

        Schema::table('order_items', function (Blueprint $table): void {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table): void {
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('orders');
    }
};
