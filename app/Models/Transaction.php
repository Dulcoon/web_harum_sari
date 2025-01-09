<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_status',
        'gross_amount',
        'items', // Menambahkan kolom items
        'customer_first_name', // Menambahkan kolom nama depan pelanggan
        'customer_last_name', // Menambahkan kolom nama belakang pelanggan
        'customer_email', // Menambahkan kolom email pelanggan
        'customer_phone', // Menambahkan kolom telepon pelanggan
    ];

    /**
     * Relationships
     */

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class); // Setiap transaksi hanya mengacu ke satu order
    }
}
