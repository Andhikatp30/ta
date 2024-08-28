<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $fillable = [
        'kurir_id',
        'nama',
        'alamat',
        'umur',
        'gender',
        'jenis_barang',
    ];

    public function pengirimens()
    {
        return $this->hasMany(Pengiriman::class,'kurir_id');
    }
    
    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang');
    }
}

