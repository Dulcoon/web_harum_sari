<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table): void {
            $table->id();
            $table->string('order_id')->unique();
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded']);
            $table->decimal('gross_amount', 15, 2);
            $table->json('items')->nullable();
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table): void {
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table): void {
            $table->dropForeign(['transaction_id']);
        });

        Schema::dropIfExists('transactions');
    }
};
