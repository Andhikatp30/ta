<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Barang;
use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengirimanController extends Controller
{
    public function create()
    {
        $barangs = Barang::all();
        $kurirs = Kurir::all();
        $pengirimens = Pengiriman::with('barang', 'kurir')->get(); // Ambil data pengiriman

        return view('pengiriman.create', compact('barangs', 'kurirs', 'pengirimens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'kurir_id' => 'required|exists:kurirs,id',
            'status_pengiriman' => 'required',
        ]);

        Pengiriman::create([
            'id_pengiriman' => Str::random(10),
            'id_barang' => $request->id_barang,
            'kurir_id' => $request->kurir_id,
            'status_pengiriman' => $request->status_pengiriman,
        ]);

        return redirect()->route('pengiriman.create')->with('success', 'Pengiriman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $barangs = Barang::all();
        $kurirs = Kurir::all();
        
        return view('pengiriman.edit', compact('pengiriman', 'barangs', 'kurirs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'kurir_id' => 'required|exists:kurirs,id',
            'status_pengiriman' => 'required',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update([
            'id_barang' => $request->id_barang,
            'kurir_id' => $request->kurir_id,
            'status_pengiriman' => $request->status_pengiriman,
        ]);

        return redirect()->route('pengiriman.create')->with('success', 'Pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();

        return redirect()->route('pengiriman.create')->with('success', 'Pengiriman berhasil dihapus.');
    }

    public function status()
    {
        $pengirimens = Pengiriman::with('barang', 'kurir')->get();
        return view('pengiriman.status', compact('pengirimens'));
    }

    public function histori()
    {
        $pengirimens = Pengiriman::with('barang', 'kurir')->get();
        return view('pengiriman.histori', compact('pengirimens'));
    }
}
