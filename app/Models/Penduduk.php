<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduks';

    protected $fillable = [
        'nik', 
        'nama', 
        'jenis_kelamin', 
        'tanggal_lahir', 
        'alamat', 
        'kelurahan', 
        'kecamatan', 
        'kabupaten', 
        'provinsi', 
        'pekerjaan', 
        'pendidikan', 
        'status_perkawinan',
        'pass_foto'
    ];
    
}
