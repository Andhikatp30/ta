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
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">ID Pengiriman</th>
                    <th class="w-1/5 px-4 py-2 text-sm md:text-base text-center">ID Barang</th>
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
                        <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->kurir->nama }}</td>
                        <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->barang->tanggal_kirim }}</td>
                        <td class="border px-4 py-2 text-sm md:text-base text-center">
                            <span class="inline-block px-3 py-1 text-sm rounded-full
                            @if($pengiriman->status_pengiriman == 'Dikirim') bg-yellow-500 text-white @endif
                            @if($pengiriman->status_pengiriman == 'Selesai') bg-green-500 text-white @endif
                            @if($pengiriman->status_pengiriman == 'Dibatalkan') bg-red-500 text-white @endif">
                                {{ $pengiriman->status_pengiriman }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
