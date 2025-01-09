<?php

// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'transaction_id',
    ];

    /**
     * Relasi ke tabel `order_items`
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // Satu order bisa memiliki banyak order item
    }

    /**
     * Relasi ke tabel `transactions`
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class); // Satu order hanya punya satu transaksi
    }
}
