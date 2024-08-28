@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-xl mb-10">
    <h2 class="text-3xl font-extrabold mb-4 text-gray-800">Dashboard Admin</h2>
    <p class="text-lg text-gray-600">Selamat datang di Dashboard Admin. Pantau aktivitas dan kinerja operasional Anda dengan mudah.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Card: Total Barang -->
    <div class="bg-blue-500 text-white p-8 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
        <div class="flex items-center">
            <div class="w-16 h-16 bg-blue-700 rounded-full flex items-center justify-center">
                <i class="fas fa-boxes text-3xl"></i>
            </div>
            <div class="ml-6">
                <h3 class="text-xl font-semibold">Total Barang</h3>
                <p class="text-3xl font-bold">{{ $totalBarang }}</p>
            </div>
        </div>
    </div>
    
    <!-- Card: Total Kurir -->
    <div class="bg-green-500 text-white p-8 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 transform hover:scale-105">
        <div class="flex items-center">
            <div class="w-16 h-16 bg-green-700 rounded-full flex items-center justify-center">
                <i class="fas fa-truck text-3xl"></i>
            </div>
            <div class="ml-6">
                <h3 class="text-xl font-semibold">Total Kurir</h3>
                <p class="text-3xl font-bold">{{ $totalKurir }}</p>
            </div>
        </div>
    </div>
    
    <!-- Card: Total Pengiriman -->
    <div class="bg-red-500 text-white p-8 rounded-lg shadow-lg hover:bg-red-600 transition duration-300 transform hover:scale-105">
        <div class="flex items-center">
            <div class="w-16 h-16 bg-red-700 rounded-full flex items-center justify-center">
                <i class="fas fa-shipping-fast text-3xl"></i>
            </div>
            <div class="ml-6">
                <h3 class="text-xl font-semibold">Total Pengiriman</h3>
                <p class="text-3xl font-bold">{{ $totalPengiriman }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Kurir Performance Chart -->
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold mb-6 text-gray-800">Performa Kurir</h3>
        <canvas id="kurirChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kurirChart').getContext('2d');
    const kurirChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($kurirNames),
            datasets: [
                {
                    label: 'Pengiriman Selesai',
                    data: @json($completedCounts),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)',
                    hoverBorderColor: 'rgba(75, 192, 192, 1)'
                },
                {
                    label: 'Pengiriman Belum Selesai',
                    data: @json($incompleteCounts),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(255, 159, 64, 0.8)',
                    hoverBorderColor: 'rgba(255, 159, 64, 1)'
                },
                {
                    label: 'Jumlah Pengiriman',
                    data: @json($pengirimanCounts),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.8)',
                    hoverBorderColor: 'rgba(54, 162, 235, 1)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Perbandingan Kinerja Kurir',
                    font: {
                        size: 20,
                        weight: 'bold'
                    },
                    padding: {
                        top: 20,
                        bottom: 30
                    },
                    color: '#333'
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.dataset.label}: ${tooltipItem.raw} pengiriman`;
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 10
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Nama Kurir',
                        color: '#333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Pengiriman',
                        color: '#333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#555'
                    }
                }
            }
        }
    });
</script>
@endsection
