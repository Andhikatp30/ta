@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="border rounded w-full py-2 px-3">
            @error('nama_barang')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nama Instansi</label>
            <input type="text" name="nama_instansi" value="{{ old('nama_instansi', $barang->nama_instansi) }}" class="border rounded w-full py-2 px-3">
            @error('nama_instansi')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Tanggal Kirim</label>
            <input type="date" name="tanggal_kirim" value="{{ old('tanggal_kirim', $barang->tanggal_kirim) }}" class="border rounded w-full py-2 px-3">
            @error('tanggal_kirim')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Alamat Instansi</label>
            <input type="text" name="alamat_instansi" value="{{ old('alamat_instansi', $barang->alamat_instansi) }}" class="border rounded w-full py-2 px-3">
            @error('alamat_instansi')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Jenis Barang</label>
            <input type="text" name="jenis_barang" value="{{ old('jenis_barang', $barang->jenis_barang) }}" class="border rounded w-full py-2 px-3">
            @error('jenis_barang')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Foto Barang</label>
            <input type="file" name="foto_barang" class="border rounded w-full py-2 px-3">
            @error('foto_barang')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        @if ($barang->foto_barang)
            <div class="mb-4">
                <label class="block text-gray-700">Foto Saat Ini</label>
                <img src="{{ asset('storage/' . $barang->foto_barang) }}" alt="Foto {{ $barang->nama_barang }}" class="h-16 w-16 object-cover">
            </div>
        @endif

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Barang</button>
        </div>
    </form>
</div>
@endsection
