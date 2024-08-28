<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use Illuminate\Http\Request;

class KinerjaKurirController extends Controller
{
    public function index()
    {
        // Ambil semua kurir
        $kurirs = Kurir::all();

        // Inisialisasi array untuk menyimpan data
        $kurirNames = [];
        $completedCounts = [];
        $incompleteCounts = [];

        foreach ($kurirs as $kurir) {
            // Simpan nama kurir
            $kurirNames[] = $kurir->nama;

            // Hitung jumlah pengiriman yang sudah selesai dan belum selesai berdasarkan id_kurir
            $completedCounts[] = $kurir->pengirimens()->where('status_pengiriman', 'selesai')->count();
            $incompleteCounts[] = $kurir->pengirimens()->where('status_pengiriman', '!=', 'selesai')->count();
        }

        return view('kinerja.index', compact('kurirNames', 'completedCounts', 'incompleteCounts'));
    }
}
