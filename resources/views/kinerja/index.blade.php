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
            <li class="flex items-center text-gray-500">
                Kinerja Kurir
            </li>
        </ol>
    </nav>

<div class="max-w-7xl mx-auto bg-white p-10 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Kinerja Kurir</h2>

    @if(empty($kurirNames) || empty($completedCounts) || empty($incompleteCounts))
        <div class="bg-red-100 text-red-600 p-6 rounded-lg shadow-md">
            <p class="text-lg">Tidak ada data pengiriman yang tersedia untuk kurir saat ini.</p>
        </div>
    @else
        <div class="chart-container" style="position: relative; height:50vh; width:100%;">
            <canvas id="kurirChart"></canvas>
        </div>
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-700">Rangkuman Kinerja Kurir</h3>
            <ul class="list-disc list-inside mt-2 text-gray-600">
                <li><strong>Total Kurir:</strong> {{ count($kurirNames) }}</li>
                <li><strong>Pengiriman Selesai:</strong> {{ array_sum($completedCounts) }}</li>
                <li><strong>Pengiriman Belum Selesai:</strong> {{ array_sum($incompleteCounts) }}</li>
            </ul>
        </div>
    @endif
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
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(75, 192, 192, 0.9)',
                    hoverBorderColor: 'rgba(75, 192, 192, 1)'
                },
                {
                    label: 'Pengiriman Belum Selesai',
                    data: @json($incompleteCounts),
                    backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(255, 159, 64, 0.9)',
                    hoverBorderColor: 'rgba(255, 159, 64, 1)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Perbandingan Kinerja Kurir: Pengiriman Selesai vs Pengiriman Belum Selesai',
                    font: {
                        size: 18,
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
