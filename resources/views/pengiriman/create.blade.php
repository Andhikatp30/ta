@extends('layouts.app')

@section('content')
<nav class="bg-gray-100 p-3 rounded-lg mb-6 shadow-sm flex items-center justify-between">
    <ol class="list-reset flex text-gray-800 space-x-2 overflow-x-auto">
        <li class="flex items-center">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
            <svg class="w-4 h-4 mx-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.293 14.707a1 1 0 010-1.414L13.586 9 9.293 4.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </li>
        <li class="flex items-center">
            <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Pengiriman Barang</a>
            <svg class="w-4 h-4 mx-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.293 14.707a1 1 0 010-1.414L13.586 9 9.293 4.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </li>
        <li class="flex items-center text-gray-500">
            Tambah Pengiriman
        </li>
    </ol>
</nav>


<div class="max-w-7xl mx-auto p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg shadow-lg">
    <h3 class="text-4xl font-bold mb-4 text-center text-gray-800">Tambah Pengiriman Barang</h3>
    <div class="container mx-auto p-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('pengiriman.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-md shadow-md">
            @csrf

            <div class="mb-4">
                <label for="id_barang" class="block text-sm font-medium text-gray-700">Pilih Barang</label>
                <select name="id_barang" id="id_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 white:border-gray-600 white:placeholder-gray-400 white:text-white white:focus:ring-blue-500 white:focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih barang...</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }} - {{ $barang->nama_instansi }} - {{ $barang->jenis_barang }} - {{ $barang->tanggal_kirim }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="kurir_id" class="block text-sm font-medium text-gray-700">Pilih Kurir</label>
                <select name="kurir_id" id="kurir_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 white:border-gray-600 white:placeholder-gray-400 white:text-white white:focus:ring-blue-500 white:focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih kurir...</option>
                    @foreach($kurirs as $kurir)
                        <option value="{{ $kurir->id }}">{{ $kurir->nama }} - {{ $kurir->jenis_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="status_pengiriman" class="block text-sm font-medium text-gray-700">Status Pengiriman</label>
                <select name="status_pengiriman" id="status_pengiriman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 white:border-gray-600 white:placeholder-gray-400 white:text-white white:focus:ring-blue-500 white:focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih status pengiriman...</option>
                    <!-- <option value="Selesai">Selesai</option>
                    <option value="Belum Selesai">Belum Selesai</option> -->
                    <option value="Akan Dikirim">Akan Dikirim</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">Tambah Pengiriman</button>
            </div>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto bg-white p-6 mt-6 rounded-lg shadow-lg">
    <h3 class="text-4xl font-bold mb-4 text-center text-gray-800">Daftar Pengiriman</h3>

    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="min-w-full bg-white border-collapse border border-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">ID Pengiriman</th>
                    <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Nama Barang</th>
                    <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Nama Kurir</th>
                    <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Status Pengiriman</th>
                    <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Tanggal Pengiriman</th>
                    <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengirimens as $pengiriman)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-300 ease-in-out">
                        <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $pengiriman->id_pengiriman }}</td>
                        <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $pengiriman->barang->nama_barang }}</td>
                        <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $pengiriman->kurir->nama }}</td>
                        <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $pengiriman->status_pengiriman }}</td>
                        <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $pengiriman->barang->tanggal_kirim }}</td>
                        <td class="border px-2 md:px-4 py-2 text-center">
                            <!-- Tombol Edit (Memicu Modal) -->
                            <button type="button" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105" data-bs-toggle="modal" data-bs-target="#editModal-{{ $pengiriman->id }}">
                                Edit
                            </button>

                            <!-- Modal untuk Edit -->
                            <div class="modal fade" id="editModal-{{ $pengiriman->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $pengiriman->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-t-lg shadow-md">
                                            <h5 class="modal-title font-semibold" id="editModalLabel-{{ $pengiriman->id }}">Edit Pengiriman</h5>
                                            <button type="button" class="btn-close text-white bg-transparent hover:bg-red-600 hover:rounded-full transition duration-300 ease-in-out" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-gray-50 p-6 rounded-b-lg">
                                            <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-4">
                                                    <label for="id_barang" class="block text-sm font-medium text-gray-700">Pilih Barang</label>
                                                    <select name="id_barang" id="id_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 white:border-gray-600 white:placeholder-gray-400 white:text-white white:focus:ring-blue-500 white:focus:border-blue-500">
                                                        @foreach($barangs as $barang)
                                                            <option value="{{ $barang->id }}" {{ $pengiriman->id_barang == $barang->id ? 'selected' : '' }}>{{ $barang->nama_barang }} - {{ $barang->nama_instansi }} - {{ $barang->jenis_barang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="kurir_id" class="block text-sm font-medium text-gray-700">Pilih Kurir</label>
                                                    <select name="kurir_id" id="kurir_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 white:border-gray-600 white:placeholder-gray-400 white:text-white white:focus:ring-blue-500 white:focus:border-blue-500">
                                                        @foreach($kurirs as $kurir)
                                                            <option value="{{ $kurir->id }}" {{ $pengiriman->kurir_id == $kurir->id ? 'selected' : '' }}>{{ $kurir->nama }} - {{ $kurir->jenis_barang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="status_pengiriman" class="block text-sm font-medium text-gray-700">Status Pengiriman</label>
                                                    <select name="status_pengiriman" id="status_pengiriman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 white:border-gray-600 white:placeholder-gray-400 white:text-white white:focus:ring-blue-500 white:focus:border-blue-500">
                                                            <!-- <option value="Selesai" {{ $pengiriman->status_pengiriman == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                            <option value="Belum Selesai" {{ $pengiriman->status_pengiriman == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option> -->
                                                        <option value="Akan Dikirim" {{ $pengiriman->status_pengiriman == 'Akan Dikirim' ? 'selected' : '' }}>Akan Dikirim</option>
                                                    </select>
                                                </div>

                                                <!-- <div class="mb-4">
                                                    <label for="tanggal_pengiriman" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
                                                    <input type="date" name="tanggal_pengiriman" id="tanggal_pengiriman" value="{{ $pengiriman->created_at->format('Y-m-d') }}" class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                                                </div> -->

                                                <div class="modal-footer justify-between bg-gray-100 rounded-b-lg p-4">
                                                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-300 ease-in-out transform hover:scale-105" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">Update Pengiriman</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Delete -->
                            <button type="button" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 transition duration-300 ease-in-out transform hover:scale-105" onclick="confirmDelete('{{ $pengiriman->id }}')">Hapus</button>

                            <form id="delete-form-{{ $pengiriman->id }}" action="{{ route('pengiriman.destroy', $pengiriman->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Controls -->
        <div class="flex items-center justify-between py-3 px-4 bg-white border-t border-gray-200">
            <div class="flex items-center">
                <span class="text-sm text-gray-700">Rows per page:</span>
                <select class="ml-2 form-select rounded border-gray-300" onchange="window.location.href=this.value">
                    @foreach([5, 10, 15, 20] as $size)
                        <option value="{{ request()->fullUrlWithQuery(['per_page' => $size]) }}" {{ $pengirimens->perPage() == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center">
                <span class="text-sm text-gray-700">Showing {{ $pengirimens->firstItem() }} to {{ $pengirimens->lastItem() }} of {{ $pengirimens->total() }}</span>
            </div>

            <div class="flex items-center">
                <a href="{{ $pengirimens->previousPageUrl() }}" class="p-2 text-sm text-gray-500 hover:text-blue-500 {{ $pengirimens->onFirstPage() ? 'cursor-not-allowed' : '' }}" aria-disabled="{{ $pengirimens->onFirstPage() }}">&#9664;</a>
                <a href="{{ $pengirimens->nextPageUrl() }}" class="ml-2 p-2 text-sm text-gray-500 hover:text-blue-500 {{ !$pengirimens->hasMorePages() ? 'cursor-not-allowed' : '' }}" aria-disabled="{{ !$pengirimens->hasMorePages() }}">&#9654;</a>
            </div>

            <!-- <div class="flex items-center">
                <a href="{{ $pengirimens->previousPageUrl() }}" 
                class="p-2 text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-in-out {{ $pengirimens->onFirstPage() ? 'cursor-not-allowed opacity-50' : '' }}" 
                aria-disabled="{{ $pengirimens->onFirstPage() }}" 
                aria-label="Previous Page">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="{{ $pengirimens->nextPageUrl() }}" 
                class="ml-2 p-2 text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-in-out {{ !$pengirimens->hasMorePages() ? 'cursor-not-allowed opacity-50' : '' }}" 
                aria-disabled="{{ !$pengirimens->hasMorePages() }}" 
                aria-label="Next Page">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div> -->
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                let alert = new bootstrap.Alert(successAlert);
                alert.close();
            }, 5000);
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
