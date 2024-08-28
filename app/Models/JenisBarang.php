<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'jenis_barangs'; // Nama tabel di database

    protected $fillable = [
        'jenis_barang', // Kolom yang dapat diisi (mass assignable)
    ];

    // Tambahkan relasi jika diperlukan
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'jenis_barang');
    }

    public function kurirs()
    {
        return $this->hasMany(Kurir::class, 'jenis_barang_id');
    }
}
