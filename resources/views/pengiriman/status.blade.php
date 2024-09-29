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
            Status Pengiriman
        </li>
    </ol>
</nav>

<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h3 class="text-4xl font-bold mb-6 text-center text-gray-800">Status Pengiriman</h3>
    <!-- Search Filters Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Status Pengiriman</h3>
        <form action="{{ route('pengiriman.status') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Combined Filter for ID Pengiriman and ID Barang -->
            <div class="col-span-1 sm:col-span-2">
                <label for="id_combined" class="block text-sm font-medium text-gray-700">ID Pengiriman atau ID Barang</label>
                <input type="text" name="id_combined" id="id_combined" value="{{ request('id_combined') }}" placeholder="Masukkan ID Pengiriman atau ID Barang" 
                class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 h-12 px-4 transition duration-200 ease-in-out">
            </div>

            <!-- Tanggal Kirim -->
            <div class="col-span-1">
                <label for="tanggal_kirim" class="block text-sm font-medium text-gray-700">Tanggal Kirim</label>
                <input type="date" name="tanggal_kirim" id="tanggal_kirim" value="{{ request('tanggal_kirim') }}" 
                class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 h-12 px-4 transition duration-200 ease-in-out">
            </div>

            <!-- Status Pengiriman -->
            <div class="col-span-1">
                <label for="status_pengiriman" class="block text-sm font-medium text-gray-700">Status Pengiriman</label>
                <select name="status_pengiriman" id="status_pengiriman" class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 h-12 px-4 transition duration-200 ease-in-out">
                    <option value="">-- Pilih Status --</option>
                    <option value="Akan Dikirim" {{ request('status_pengiriman') == 'Akan Dikirim' ? 'selected' : '' }}>Akan Dikirim</option>
                    <option value="Selesai" {{ request('status_pengiriman') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Belum Selesai" {{ request('status_pengiriman') == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
                </select>
            </div>

            <!-- Buttons (Search & Reset) -->
            <div class="col-span-1 sm:col-span-2 lg:col-span-4 flex justify-end space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all ease-in-out duration-150">
                    Search
                </button>
                <a href="{{ route('pengiriman.status') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-all ease-in-out duration-150">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">ID Pengiriman</th>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">ID Barang</th>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">Nama Barang</th>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">Nama Kurir</th>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">Tanggal Kirim</th>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">Status Pengiriman</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengirimens as $pengiriman)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->id_pengiriman }}</td>
                        <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->barang->id_barang }}</td>
                        <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->barang->nama_barang }}</td>
                        <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->kurir->nama }}</td>
                        <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->barang->tanggal_kirim }}</td>
                        <td class="border px-4 py-2 text-sm md:text-base text-center">
                            <span class="inline-block px-3 py-1 text-sm rounded-full
                            @if($pengiriman->status_pengiriman == 'Akan Dikirim') bg-yellow-500 text-white @endif
                            @if($pengiriman->status_pengiriman == 'Selesai') bg-green-500 text-white @endif
                            @if($pengiriman->status_pengiriman == 'Belum Selesai') bg-red-500 text-white @endif">
                                {{ $pengiriman->status_pengiriman }}
                            </span>
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
        </div>
    </div>
</div>
@endsection
