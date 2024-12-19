<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama',
        'thumbnail'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }
}
