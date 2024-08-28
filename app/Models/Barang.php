<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'nama_instansi',
        'tanggal_kirim',
        'alamat_instansi',
        'jenis_barang',
        'foto_barang',
    ];

    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class);
    }

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang');
    }
}

