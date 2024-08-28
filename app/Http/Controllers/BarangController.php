<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($search = $request->input('search')) {
            $query->where('nama_barang', 'LIKE', "%{$search}%")
                ->orWhere('nama_instansi', 'LIKE', "%{$search}%")
                ->orWhere('alamat_instansi', 'LIKE', "%{$search}%")
                ->orWhere('jenis_barang', 'LIKE', "%{$search}%")
                ->orWhere('id_barang', 'LIKE', "%{$search}%");
        }

        $barangs = $query->paginate(10);
        $jenis_barangs = JenisBarang::all();  // Pastikan untuk mengambil data jenis barang

        return view('barang.index', compact('barangs', 'jenis_barangs')); // Kirimkan $jenis_barangs ke view
    }

    public function create()
    {
        $jenis_barangs = JenisBarang::all();
        return view('barang.create', compact('jenis_barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'nama_instansi' => 'required',
            'tanggal_kirim' => 'required|date',
            'alamat_instansi' => 'required',
            'jenis_barang' => 'required',
            'foto_barang' => 'nullable|image',
        ]);

        $barang = new Barang();
        $barang->id_barang = Str::random(10);
        $barang->nama_barang = $request->nama_barang;
        $barang->nama_instansi = $request->nama_instansi;
        $barang->tanggal_kirim = $request->tanggal_kirim;
        $barang->alamat_instansi = $request->alamat_instansi;
        $barang->jenis_barang = $request->jenis_barang;

        if ($request->hasFile('foto_barang')) {
            // Simpan gambar dan simpan path-nya di database
            $path = $request->file('foto_barang')->store('images', 'public');
            $barang->foto_barang = $path;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        $jenis_barangs = JenisBarang::all();
        return view('barang.edit', compact('barang', 'jenis_barangs'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'nama_instansi' => 'required',
            'tanggal_kirim' => 'required|date',
            'alamat_instansi' => 'required',
            'jenis_barang' => 'required',
            'foto_barang' => 'nullable|image',
        ]);

        $barang->nama_barang = $request->nama_barang;
        $barang->nama_instansi = $request->nama_instansi;
        $barang->tanggal_kirim = $request->tanggal_kirim;
        $barang->alamat_instansi = $request->alamat_instansi;
        $barang->jenis_barang = $request->jenis_barang;

        if ($request->hasFile('foto_barang')) {
            // Hapus gambar lama jika ada
            if ($barang->foto_barang && \Storage::disk('public')->exists($barang->foto_barang)) {
                \Storage::disk('public')->delete($barang->foto_barang);
            }
            // Simpan gambar baru dan simpan path-nya di database
            $path = $request->file('foto_barang')->store('images', 'public');
            $barang->foto_barang = $path;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy(Barang $barang)
    {
        // Hapus semua entri di 'pengirimens' yang terkait dengan barang ini
        \DB::table('pengirimens')->where('id_barang', $barang->id)->delete();

        // Lanjutkan menghapus barang
        if ($barang->foto_barang && \Storage::disk('public')->exists($barang->foto_barang)) {
            \Storage::disk('public')->delete($barang->foto_barang);
        }
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
