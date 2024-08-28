@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Tambah Barang</h2>

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="nama_barang" class="block text-gray-700">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="nama_instansi" class="block text-gray-700">Nama Instansi:</label>
            <input type="text" name="nama_instansi" id="nama_instansi" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="tanggal_kirim" class="block text-gray-700">Tanggal Kirim:</label>
            <input type="date" name="tanggal_kirim" id="tanggal_kirim" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="alamat_instansi" class="block text-gray-700">Alamat Instansi:</label>
            <input type="text" name="alamat_instansi" id="alamat_instansi" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="jenis_barang" class="block text-gray-700">Jenis Barang:</label>
            <input type="text" name="jenis_barang" id="jenis_barang" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="foto_barang" class="block text-gray-700">Foto Barang:</label>
            <input type="file" name="foto_barang" id="foto_barang" class="w-full p-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
