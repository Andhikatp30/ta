@extends('layouts.app')

@section('content')
<nav class="bg-gray-100 p-3 rounded-lg mb-6 shadow-sm">
        <ol class="list-reset flex text-gray-800 space-x-2">
            <li class="flex items-center">
                <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                <svg class="w-4 h-4 mx-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M9.293 14.707a1 1 0 010-1.414L13.586 9 9.293 4.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="flex items-center">
                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Data Kurir</a>
                <svg class="w-4 h-4 mx-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M9.293 14.707a1 1 0 010-1.414L13.586 9 9.293 4.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="flex items-center text-gray-500">
                Daftar Kurir
            </li>
        </ol>
    </nav>
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-4xl font-bold mb-4 text-center">Daftar Kurir</h3>
    <div class="container mx-auto p-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Pencarian dan Tombol "Tambah Kurir" -->
        <div class="flex flex-col space-y-4 mb-4">
            <button type="button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg self-center md:self-start hover:bg-blue-600 transition-transform duration-300 transform hover:scale-105" data-bs-toggle="modal" data-bs-target="#addKurirModal">
                Tambah Kurir
            </button>
            
            <form action="{{ route('kurir.index') }}" method="GET" class="flex w-full">
                <input type="text" name="search" class="form-control flex-grow rounded-l py-2 px-4" placeholder="Cari Kurir..." value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 ml-2 transition-transform duration-300 transform hover:scale-105">Cari</button>
            </form>
        </div>

        <!-- Modal Tambah Kurir -->
        <div class="modal fade" id="addKurirModal" tabindex="-1" aria-labelledby="addKurirModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-to-b from-blue-500 to-indigo-600 text-white rounded-t-lg shadow-md">
                        <h5 class="modal-title font-semibold" id="addKurirModalLabel">Tambah Kurir</h5>
                        <button type="button" class="btn-close text-white bg-transparent hover:bg-red-600 hover:rounded-full transition duration-300 ease-in-out" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-gray-50 p-6 rounded-b-lg">
                        <form action="{{ route('kurir.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama kurir" required>
                            </div>
                            <div class="mb-4">
                                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat kurir" required>
                            </div>
                            <div class="mb-4">
                                <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                                <input type="number" class="form-control" id="umur" name="umur" placeholder="Masukkan umur kurir" required>
                            </div>
                            <div class="mb-4">
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="" disabled selected>Pilih gender...</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="jenis_barang" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
                                <select class="form-control" id="jenis_barang" name="jenis_barang" required>
                                    <option value="" disabled selected>Pilih jenis barang...</option>
                                    @foreach ($jenis_barangs as $jenis_barang)
                                        <option value="{{ $jenis_barang->id }}">{{ $jenis_barang->jenis_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-300 ease-in-out transform hover:scale-105" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Kurir -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full bg-white border-collapse border border-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">ID Kurir</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Nama</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Alamat</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Umur</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Gender</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Jenis Barang</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($kurirs as $kurir)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-300">
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $kurir->kurir_id }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $kurir->nama }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $kurir->alamat }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $kurir->umur }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $kurir->gender }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $kurir->jenisBarang->jenis_barang ?? 'Jenis Barang Tidak Ditemukan' }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base text-center">
                                <button type="button" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 transition-transform duration-300 transform hover:scale-105" data-bs-toggle="modal" data-bs-target="#editKurirModal-{{ $kurir->id }}">
                                    Edit
                                </button>
                                <button type="button" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 transition-transform duration-300 transform hover:scale-105" onclick="confirmDelete('{{ $kurir->id }}')">Hapus</button>

                                <form id="delete-form-{{ $kurir->id }}" action="{{ route('kurir.destroy', $kurir->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Kurir -->
                        <div class="modal fade" id="editKurirModal-{{ $kurir->id }}" tabindex="-1" aria-labelledby="editKurirModalLabel-{{ $kurir->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-to-b from-blue-500 to-indigo-600 text-white rounded-t-lg shadow-md">
                                        <h5 class="modal-title" id="editKurirModalLabel-{{ $kurir->id }}">Edit Kurir</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('kurir.update', $kurir->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label for="nama-{{ $kurir->id }}" class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input type="text" class="form-control" id="nama-{{ $kurir->id }}" name="nama" value="{{ $kurir->nama }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="alamat-{{ $kurir->id }}" class="block text-sm font-medium text-gray-700">Alamat</label>
                                                <input type="text" class="form-control" id="alamat-{{ $kurir->id }}" name="alamat" value="{{ $kurir->alamat }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="umur-{{ $kurir->id }}" class="block text-sm font-medium text-gray-700">Umur</label>
                                                <input type="number" class="form-control" id="umur-{{ $kurir->id }}" name="umur" value="{{ $kurir->umur }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="gender-{{ $kurir->id }}" class="block text-sm font-medium text-gray-700">Gender</label>
                                                <select class="form-control" id="gender-{{ $kurir->id }}" name="gender" required>
                                                    <option value="Laki-laki" {{ $kurir->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ $kurir->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="jenis_barang-{{ $kurir->id }}" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
                                                <select class="form-control" id="jenis_barang-{{ $kurir->id }}" name="jenis_barang" required>
                                                    @foreach ($jenis_barangs as $jenis_barang)
                                                        <option value="{{ $jenis_barang->id }}" {{ $kurir->jenis_barang == $jenis_barang->id ? 'selected' : '' }}>{{ $jenis_barang->jenis_barang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambahkan skrip ini di bagian bawah template -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                let alert = new bootstrap.Alert(successAlert);
                alert.close();
            }, 5000); // 5000ms = 5 detik
        }
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan bisa mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

@endsection
