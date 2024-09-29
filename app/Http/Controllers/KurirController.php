<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KurirController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);

        $kurirs = Kurir::query()
            ->when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                            ->orWhere('alamat', 'like', "%{$search}%")
                            ->orWhere('umur', 'like', "%{$search}%")
                            ->orWhere('gender', 'like', "%{$search}%")
                            ->orWhere('kurir_id', 'like', "%{$search}%");
            })
            ->paginate($perPage);

        $jenis_barangs = JenisBarang::all();  // Pastikan untuk mengambil data jenis barang
        return view('kurir.index', compact('kurirs', 'jenis_barangs'));
    }

    public function create()
    {
        $jenis_barangs = JenisBarang::all();
        return view('kurir.create', compact('jenis_barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'umur' => 'required|integer',
            'gender' => 'required',
            'jenis_barang' => 'required',
        ]);

        Kurir::create([
            'kurir_id' => Str::random(10),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'umur' => $request->umur,
            'gender' => $request->gender,
            'jenis_barang' => $request->jenis_barang,
        ]);

        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil ditambahkan.');
    }

    public function edit(Kurir $kurir)
    {
        return view('kurir.edit', compact('kurir', 'jenis_barangs'));
    }

    public function update(Request $request, Kurir $kurir)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'umur' => 'required|integer',
            'gender' => 'required',
            'jenis_barang' => 'required',
        ]);

        $kurir->update($request->all());

        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil diupdate.');
    }

    public function destroy(Kurir $kurir)
    {
        $kurir->delete();
        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil dihapus.');
    }
}

