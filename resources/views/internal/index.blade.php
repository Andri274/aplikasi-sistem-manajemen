@extends('layouts.main')

@section('title', 'Dashboard Internal')

@section('content')
    <div class="space-y-8 text-center">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6">📊 Dashboard Internal</h1>

        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Produksi --}}
            <a href="{{ route('internal.produksi.index') }}"
                class="block bg-white rounded-2xl shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl hover:ring-4 hover:ring-green-300">
                <p class="text-gray-500 text-sm">Total Produksi</p>
                <p class="text-4xl font-extrabold text-green-500 mt-2">{{ number_format($totalProduksi, 0, ',', '.') }} Kg
                </p>
            </a>

            {{-- Total Karyawan --}}
            <a href="{{ route('internal.karyawan.index') }}"
                class="block bg-white rounded-2xl shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl hover:ring-4 hover:ring-blue-300">
                <p class="text-gray-500 text-sm">Total Karyawan</p>
                <p class="text-4xl font-extrabold text-blue-500 mt-2">{{ $totalKaryawan }}</p>
            </a>

            {{-- Absensi Hari Ini --}}
            <a href="{{ route('internal.absensi.index') }}"
                class="block bg-white rounded-2xl shadow-lg p-6 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl hover:ring-4 hover:ring-purple-300">
                <p class="text-gray-500 text-sm">Absensi Hari Ini</p>
                <p class="text-4xl font-extrabold text-purple-500 mt-2">{{ $totalAbsensiHariIni }}</p>
            </a>
        </div>



        {{-- Slip Gaji Terbaru --}}
        <div class="bg-white rounded-xl shadow-lg p-6 mt-8 hover:ring-2 hover:ring-blue-300 transition">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">🧾 Slip Gaji Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left">Nama Karyawan</th>
                            <th class="px-4 py-3 text-left">Periode</th>
                            <th class="px-4 py-3 text-left">Total Bersih</th>
                            <th class="px-4 py-3 text-left">Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($slipGajiTerbaru as $slip)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $slip->karyawan->nama }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($slip->periode_mulai)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($slip->periode_selesai)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-2 text-green-600 font-semibold">
                                    Rp {{ number_format($slip->total_bersih, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2">{{ $slip->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-400 py-4 italic">Belum ada slip gaji.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Grafik Produksi --}}
        <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">📈 Grafik Produksi HBL-FACTORY</h2>
            <canvas id="grafikProduksi" height="100"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('grafikProduksi').getContext('2d');
        const grafikProduksi = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Total Produksi (Kg)',
                    data: @json($data),
                    backgroundColor: 'rgba(34, 197, 94, 0.7)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Kg'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#f3f4f6',
                        titleColor: '#111827',
                        bodyColor: '#111827'
                    }
                }
            }
        });
    </script>
@endsection
