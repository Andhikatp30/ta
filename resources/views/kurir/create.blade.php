@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Tambah Kurir Baru</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kurir.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Kurir:</label>
            <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat:</label>
            <textarea name="alamat" id="alamat" class="w-full p-2 border border-gray-300 rounded-lg" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="umur" class="block text-gray-700 font-bold mb-2">Umur:</label>
            <input type="number" name="umur" id="umur" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('umur') }}" required>
        </div>

        <div class="mb-4">
            <label for="gender" class="block text-gray-700 font-bold mb-2">Jenis Kelamin:</label>
            <select name="gender" id="gender" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="jenis_barang" class="block text-gray-700">Jenis Barang:</label>
            <input type="text" name="jenis_barang" id="jenis_barang" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Simpan</button>
            <a href="{{ route('kurir.index') }}" class="text-blue-500 ml-4">Batal</a>
        </div>
    </form>
</div>
@endsection
