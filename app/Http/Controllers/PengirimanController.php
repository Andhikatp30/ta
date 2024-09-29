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
        $pengirimens = Pengiriman::with('barang', 'kurir')->paginate(request('per_page', 5)); // Use pagination and check for 'per_page' request

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

    // public function edit($id)
    // {
    //     $pengiriman = Pengiriman::findOrFail($id);
    //     $barangs = Barang::all();
    //     $kurirs = Kurir::all();
        
    //     return view('pengiriman.edit', compact('pengiriman', 'barangs', 'kurirs'));
    // }

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

    public function status(Request $request)
    {
        $query = Pengiriman::with('barang', 'kurir');

        // Filter based on combined input of ID Pengiriman or ID Barang
        if ($request->filled('id_combined')) {
            $query->where('id_pengiriman', 'like', '%' . $request->id_combined . '%')
                ->orWhereHas('barang', function ($q) use ($request) {
                    $q->where('id_barang', 'like', '%' . $request->id_combined . '%')
                    ->orwhere('nama_barang', 'like', '%' . $request->id_combined . '%');
                })
                ->orWhereHas('kurir', function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->id_combined . '%');
                });
        }

        // Filter berdasarkan tanggal pengiriman
        if ($request->filled('tanggal_kirim')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->whereDate('tanggal_kirim', $request->tanggal_kirim);
            });
        }

        // Filter berdasarkan status pengiriman
        if ($request->filled('status_pengiriman')) {
            $query->where('status_pengiriman', 'like', '%' . $request->status_pengiriman . '%');
        }

        $pengirimens = $query->paginate($request->get('per_page', 5));
        
        return view('pengiriman.status', compact('pengirimens'));
    }

    public function histori(Request $request)
    {
        $query = Pengiriman::with('barang', 'kurir');

        // Combined Filter for ID Pengiriman, ID Barang, Nama Kurir, Nama Barang, and Alamat Instansi
        if ($request->filled('id_combined')) {
            $searchTerm = '%' . $request->id_combined . '%';

            $query->where('id_pengiriman', 'like', $searchTerm)
                ->orWhereHas('barang', function ($q) use ($searchTerm) {
                    $q->where('id_barang', 'like', $searchTerm)
                    ->orWhere('nama_barang', 'like', $searchTerm)
                    ->orWhere('alamat_instansi', 'like', $searchTerm);
                })
                ->orWhereHas('kurir', function ($q) use ($searchTerm) {
                    $q->where('nama', 'like', $searchTerm);
                });
        }

        // Filter by Tanggal Kirim
        if ($request->filled('tanggal_kirim')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->whereDate('tanggal_kirim', $request->tanggal_kirim);
            });
        }

        // Filter by Status Pengiriman
        if ($request->filled('status_pengiriman')) {
            $query->where('status_pengiriman', $request->status_pengiriman);
        }

        // Paginate the results
        $pengirimens = $query->paginate($request->get('per_page', 5));

        // Return the view with filtered data
        return view('pengiriman.histori', compact('pengirimens'));
    }
}


// namespace App\Http\Controllers;

// use App\Models\Pengiriman;
// use App\Models\Barang;
// use App\Models\Kurir;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;

// class PengirimanController extends Controller
// {
//     public function create(Request $request)
// {
//     $barangs = Barang::all();

//     $filteredKurirs = collect(); // Default nilai kosong

//     $selectedBarangId = $request->input('id_barang');
//     if ($selectedBarangId) {
//         $selectedBarang = Barang::find($selectedBarangId);
//         if ($selectedBarang) {
//             // Filter kurir berdasarkan jenis barang yang dipilih
//             $filteredKurirs = Kurir::where('jenis_barang', $selectedBarang->jenis_barang)->get();
//         }
//     }

//     $pengirimens = Pengiriman::with('barang', 'kurir')->get();

//     return view('pengiriman.create', compact('barangs', 'filteredKurirs', 'pengirimens'));
// }


//     public function store(Request $request)
//     {
//         $request->validate([
//             'id_barang' => 'required|exists:barangs,id',
//             'kurir_id' => 'required|exists:kurirs,id',
//             'status_pengiriman' => 'required',
//         ]);

//         // Validasi jenis barang sesuai dengan kurir yang dipilih
//         $barang = Barang::findOrFail($request->id_barang);
//         $kurir = Kurir::findOrFail($request->kurir_id);

//         if ($barang->jenis_barang !== $kurir->jenis_barang) {
//             return redirect()->back()->withErrors('Kurir tidak sesuai dengan jenis barang yang dipilih.');
//         }

//         Pengiriman::create([
//             'id_pengiriman' => Str::random(10),
//             'id_barang' => $request->id_barang,
//             'kurir_id' => $request->kurir_id,
//             'status_pengiriman' => $request->status_pengiriman,
//         ]);

//         return redirect()->route('pengiriman.create')->with('success', 'Pengiriman berhasil ditambahkan.');
//     }

//     public function edit($id)
//     {
//         $pengiriman = Pengiriman::findOrFail($id);
//         $barangs = Barang::all();

//         // Memfilter kurir berdasarkan jenis barang yang terkait dengan pengiriman ini
//         $filteredKurirs = Kurir::where('jenis_barang', $pengiriman->barang->jenis_barang)->get();
        
//         return view('pengiriman.edit', compact('pengiriman', 'barangs', 'filteredKurirs'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'id_barang' => 'required|exists:barangs,id',
//             'kurir_id' => 'required|exists:kurirs,id',
//             'status_pengiriman' => 'required',
//         ]);

//         $pengiriman = Pengiriman::findOrFail($id);

//         // Validasi jenis barang sesuai dengan kurir yang dipilih
//         $barang = Barang::findOrFail($request->id_barang);
//         $kurir = Kurir::findOrFail($request->kurir_id);

//         if ($barang->jenis_barang !== $kurir->jenis_barang) {
//             return redirect()->back()->withErrors('Kurir tidak sesuai dengan jenis barang yang dipilih.');
//         }

//         $pengiriman->update([
//             'id_barang' => $request->id_barang,
//             'kurir_id' => $request->kurir_id,
//             'status_pengiriman' => $request->status_pengiriman,
//         ]);

//         return redirect()->route('pengiriman.create')->with('success', 'Pengiriman berhasil diperbarui.');
//     }

//     public function destroy($id)
//     {
//         $pengiriman = Pengiriman::findOrFail($id);
//         $pengiriman->delete();

//         return redirect()->route('pengiriman.create')->with('success', 'Pengiriman berhasil dihapus.');
//     }

//     public function status()
//     {
//         $pengirimens = Pengiriman::with('barang', 'kurir')->get();
//         return view('pengiriman.status', compact('pengirimens'));
//     }

//     public function histori()
//     {
//         $pengirimens = Pengiriman::with('barang', 'kurir')->get();
//         return view('pengiriman.histori', compact('pengirimens'));
//     }
// }

