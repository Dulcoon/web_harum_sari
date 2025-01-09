<?php

// app/Models/OrderItem.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    /**
     * Relasi ke tabel `orders`
     */
    public function order()
    {
        return $this->belongsTo(Order::class); // Banyak order items mengacu ke satu order
    }

    /**
     * Relasi ke tabel `products`
     */
    public function product()
    {
        return $this->belongsTo(Product::class); // Setiap order item mengacu ke satu produk
    }
}
