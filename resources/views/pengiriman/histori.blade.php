@extends('layouts.app')

@section('content')
    <nav class="bg-white p-3 rounded-lg mb-6 shadow-sm">
        <ol class="list-reset flex text-gray-800 space-x-2">
            <li class="flex items-center">
                <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                <svg class="w-4 h-4 mx-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M9.293 14.707a1 1 0 010-1.414L13.586 9 9.293 4.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="flex items-center text-gray-500">
                Histori Pengiriman
            </li>
        </ol>
    </nav>

    <div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h3 class="text-4xl font-bold mb-6 text-center text-gray-800">Histori Pengiriman</h3>

        <!-- Tombol Print & Download PDF -->
        <div class="mb-6 text-right">
            <button onclick="printAndDownloadPDF()" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition-transform duration-300 transform hover:scale-105">
                Print & Download PDF
            </button>
        </div>

        <div class="overflow-x-auto">
            <table id="historiTable" class="min-w-full bg-white border-collapse border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/7 px-4 py-2 text-sm md:text-base text-center">ID Pengiriman</th>
                        <th class="w-1/7 px-4 py-2 text-sm md:text-base text-center">ID Barang</th>
                        <th class="w-1/7 px-4 py-2 text-sm md:text-base text-center">Nama Kurir</th>
                        <th class="w-1/7 px-4 py-2 text-sm md:text-base text-center">Nama Barang</th>
                        <th class="w-1/7 px-4 py-2 text-sm md:text-base text-center">Alamat Instansi</th>
                        <th class="w-1/7 px-4 py-2 text-sm md:text-base text-center">Tanggal Kirim</th>
                        <th class="w-1/7 px-4 py-2 text-sm md:text-base text-center">Status Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengirimens as $pengiriman)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->id_pengiriman }}</td>
                            <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->barang->id_barang }}</td>
                            <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->kurir->nama }}</td>
                            <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->barang->nama_barang }}</td>
                            <td class="border px-4 py-2 text-sm md:text-base text-center">{{ $pengiriman->barang->alamat_instansi }}</td>
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

    <!-- Template Print untuk Logo dan Alamat -->
    <div id="printTemplate" class="hidden">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('storage/images/logo2.png') }}" alt="Logo Perusahaan" style="max-width: 150px; margin-bottom: 10px;">
            <p style="font-size: 14px;">PT Sinergi Lintas Global</p>
            <p style="font-size: 14px;">Jl. Swadaya Raya No.90, Bambu Apus, Kec. Cipayung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13890</p>
        </div>
        <div id="tableContainer">
            <!-- Tabel pengiriman akan dimuat di sini -->
        </div>
    </div>

    <!-- Script untuk Print dan Download PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function printAndDownloadPDF() {
            // Clone tabel pengiriman dan tambahkan ke dalam template print
            const tableClone = document.getElementById('historiTable').cloneNode(true);
            const tableContainer = document.getElementById('printTemplate').querySelector('#tableContainer');
            tableContainer.innerHTML = '';
            tableContainer.appendChild(tableClone);

            // Membuka halaman print dengan template print
            const printContents = document.getElementById('printTemplate').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            // Setelah print selesai, download PDF
            setTimeout(() => {
                exportTableToPDF();
            }, 1000);
        }

        function exportTableToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('landscape');

            // Clone tabel pengiriman dan tambahkan ke dalam template print
            const tableClone = document.getElementById('historiTable').cloneNode(true);
            const tableContainer = document.getElementById('printTemplate').querySelector('#tableContainer');
            tableContainer.innerHTML = '';
            tableContainer.appendChild(tableClone);

            html2canvas(document.getElementById('printTemplate'), { useCORS: true }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgProps = doc.getImageProperties(imgData);
                const pdfWidth = doc.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                doc.save("histori_pengiriman.pdf");
            });
        }
    </script>
@endsection
