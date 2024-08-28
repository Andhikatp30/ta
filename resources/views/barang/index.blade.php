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
                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Data Barang</a>
                <svg class="w-4 h-4 mx-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M9.293 14.707a1 1 0 010-1.414L13.586 9 9.293 4.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="flex items-center text-gray-500">
                Daftar Barang
            </li>
        </ol>
    </nav>

<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-4xl font-bold mb-4 text-center">Daftar Barang</h3>
    <div class="container mx-auto p-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Pencarian dan Tombol "Tambah Barang" -->
        <div class="flex flex-col space-y-4 mb-4">
            <button type="button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded self-center md:self-start hover:bg-blue-800 transition-transform duration-300 transform hover:scale-105" data-bs-toggle="modal" data-bs-target="#tambahBarangModal">
                Tambah Barang
            </button>
            
            <form action="{{ route('barang.index') }}" method="GET" class="flex w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
                <input type="search" name="search" class="form-control flex-grow rounded-l py-2 px-4" placeholder="Cari barang..." value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 ml-2 transition-transform duration-300 transform hover:scale-105">Cari</button>
            </form>
        </div>

        <!-- Modal Tambah Barang -->
        <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBarangModalLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Tambah Barang -->
                        <form id="formTambahBarang" action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700">Nama Barang</label>
                                <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-control">
                                @error('nama_barang')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Nama Instansi</label>
                                <input type="text" name="nama_instansi" value="{{ old('nama_instansi') }}" class="form-control">
                                @error('nama_instansi')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Tanggal Kirim</label>
                                <input type="date" name="tanggal_kirim" value="{{ old('tanggal_kirim') }}" class="form-control">
                                @error('tanggal_kirim')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Alamat Instansi</label>
                                <input type="text" name="alamat_instansi" value="{{ old('alamat_instansi') }}" class="form-control">
                                @error('alamat_instansi')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Jenis Barang</label>
                                <select name="jenis_barang" class="form-control">
                                    @foreach($jenis_barangs as $jenis)
                                        <option value="{{ $jenis->jenis_barang }}" {{ old('jenis_barang', $barang->jenis_barang ?? '') == $jenis->jenis_barang ? 'selected' : '' }}>
                                            {{ $jenis->jenis_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_barang')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Foto Barang</label>
                                <!-- <input type="file" name="foto_barang" id="foto_barang" class="form-control"> -->
                                <input type="file" name="foto_barang" id="foto_barang" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 white:text-gray-400 focus:outline-none white:bg-gray-700 white:border-gray-600 white:placeholder-gray-400">
                                    <p class="mt-1 text-sm text-gray-500 white:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                                <div id="progress-bar-container" class="mt-2" style="display:none;">
                                    <div id="progress-bar" class="progress-bar bg-blue-500 h-2 rounded" style="width: 0%;"></div>
                                </div>
                                @error('foto_barang')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah Barang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Barang -->
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white border-collapse border border-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">ID Barang</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Nama Barang</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Nama Instansi</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Alamat Instansi</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Tanggal Kirim</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Jenis Barang</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Foto Barang</th>
                        <th class="w-1/6 px-2 md:px-4 py-2 text-xs md:text-base border border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-300">
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $barang->id_barang }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $barang->nama_barang }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $barang->nama_instansi }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $barang->alamat_instansi }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $barang->tanggal_kirim }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">{{ $barang->jenis_barang }}</td>
                            <td class="border px-2 md:px-4 py-2 text-xs md:text-base">
                                @if ($barang->foto_barang)
                                    <img src="{{ asset('storage/' . $barang->foto_barang) }}" alt="Foto {{ $barang->nama_barang }}" class="h-16 w-16 object-cover rounded">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td class="border px-2 md:px-4 py-2 text-center">
                                <!-- Tombol untuk membuka modal -->
                                <button type="button" class="bg-yellow-500 text-white py-1 px-2 rounded mb-2 hover:bg-yellow-600 transition-transform duration-300 transform hover:scale-105" data-bs-toggle="modal" data-bs-target="#editModal-{{ $barang->id }}">
                                    Edit
                                </button>

                                <!-- Modal Edit Barang -->
                                <div class="modal fade" id="editModal-{{ $barang->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $barang->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel-{{ $barang->id }}">Edit Barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form Edit -->
                                                <form id="formEditBarang-{{ $barang->id }}" action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-4">
                                                        <label class="block text-gray-700">Nama Barang</label>
                                                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="form-control">
                                                        @error('nama_barang')
                                                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="block text-gray-700">Nama Instansi</label>
                                                        <input type="text" name="nama_instansi" value="{{ old('nama_instansi', $barang->nama_instansi) }}" class="form-control">
                                                        @error('nama_instansi')
                                                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="block text-gray-700">Tanggal Kirim</label>
                                                        <input type="date" name="tanggal_kirim" value="{{ old('tanggal_kirim', $barang->tanggal_kirim) }}" class="form-control">
                                                        @error('tanggal_kirim')
                                                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="block text-gray-700">Alamat Instansi</label>
                                                        <input type="text" name="alamat_instansi" value="{{ old('alamat_instansi', $barang->alamat_instansi) }}" class="form-control">
                                                        @error('alamat_instansi')
                                                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="block text-gray-700">Jenis Barang</label>
                                                        <select name="jenis_barang" class="form-control">
                                                            @foreach($jenis_barangs as $jenis)
                                                                <option value="{{ $jenis->jenis_barang }}" {{ old('jenis_barang', $barang->jenis_barang ?? '') == $jenis->jenis_barang ? 'selected' : '' }}>
                                                                    {{ $jenis->jenis_barang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('jenis_barang')
                                                            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="block text-gray-700">Foto Barang</label>
                                                        <input type="file" name="foto_barang" id="foto_barang_edit_{{ $barang->id }}" class="form-control">
                                                        <div id="progress-bar-container-edit-{{ $barang->id }}" class="mt-2" style="display:none;">
                                                            <div id="progress-bar-edit-{{ $barang->id }}" class="progress-bar bg-blue-500 h-2 rounded" style="width: 0%;"></div>
                                                        </div>
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

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Update Barang</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 transition-transform duration-300 transform hover:scale-105" onclick="confirmDelete('{{ $barang->id }}')">Hapus</button>

                                <form id="delete-form-{{ $barang->id }}" action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
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

        document.getElementById('foto_barang').addEventListener('change', function(event) {
            handleFileUpload(event, 'progress-bar');
        });

        document.querySelectorAll('input[type="file"][id^="foto_barang_edit_"]').forEach(function(input) {
            input.addEventListener('change', function(event) {
                const id = event.target.id.replace('foto_barang_edit_', '');
                handleFileUpload(event, `progress-bar-edit-${id}`);
            });
        });

    });

    function handleFileUpload(event, progressBarId) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        const progressBar = document.getElementById(progressBarId);
        const progressBarContainer = progressBar.parentElement;
        
        if (file) {
            progressBarContainer.style.display = 'block';
            const reader = new FileReader();
            reader.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    progressBar.style.width = percentComplete + '%';
                }
            };
            reader.onloadend = function() {
                setTimeout(() => {
                    progressBarContainer.style.display = 'none';
                }, 1000);
            };
            reader.readAsDataURL(file);
        }
    }

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
