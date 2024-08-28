<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kurir;
use App\Models\Pengiriman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalKurir = Kurir::count();
        $totalPengiriman = Pengiriman::count();
        // Ambil semua kurir
        $kurirs = Kurir::all();

        // Inisialisasi array untuk menyimpan data
        $kurirNames = [];
        $completedCounts = [];
        $incompleteCounts = [];

        foreach ($kurirs as $kurir) {
            // Simpan nama kurir
            $kurirNames[] = $kurir->nama;

            // Hitung jumlah pengiriman yang sudah selesai dan belum selesai
            $completedCounts[] = $kurir->pengirimens()->where('status_pengiriman', 'selesai')->count();
            $incompleteCounts[] = $kurir->pengirimens()->where('status_pengiriman', '!=', 'selesai')->count();

        }

        $recentActivities = []; // Sesuaikan dengan data yang Anda miliki

        // Jika Anda juga menggunakan data untuk chart
        $kurirNames = Kurir::pluck('nama')->toArray();
        $pengirimanCounts = Kurir::withCount('pengirimens')->pluck('pengirimens_count')->toArray();

        return view('dashboard', compact('totalBarang', 'totalKurir', 'totalPengiriman', 'recentActivities', 'kurirNames', 'pengirimanCounts', 'completedCounts', 'incompleteCounts'));
    }
}
