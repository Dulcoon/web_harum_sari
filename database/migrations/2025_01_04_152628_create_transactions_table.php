<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // ID transaksi
            $table->string('order_id')->unique(); // ID pesanan
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded']);
            $table->decimal('gross_amount', 15, 2); // Jumlah total
            $table->json('items')->nullable(); // Item yang dibeli (JSON)
            $table->string('customer_first_name'); // Nama depan pelanggan
            $table->string('customer_last_name'); // Nama belakang pelanggan
            $table->string('customer_email')->nullable(); // Email pelanggan
            $table->string('customer_phone')->nullable(); // Telepon pelanggan
            $table->unsignedBigInteger('user_id'); // ID pengguna yang membuat transaksi
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key constraint (jika ada tabel users)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};