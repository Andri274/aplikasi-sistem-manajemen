@extends('layouts.vendor')

@section('title', 'Laporan Produksi Vendor')

@section('content')
    <div x-data="{
        mesin1: 0,
        mesin2: 0,
        mesin3: 0,
        mesinBesar: 0,
        hasilJadi: 0,
        hasilCacat: 0,
        targetHarian: 16000,
        get totalProduksi() { return this.mesin1 + this.mesin2 + this.mesin3 + this.mesinBesar; },
        get tercapai() { return this.hasilJadi - this.hasilCacat; },
        get belumTercapai() { return this.targetHarian - this.tercapai; },
        get persenTercapai() {
            return this.targetHarian > 0 ?
                ((this.tercapai / this.targetHarian) * 100).toFixed(2) :
                '0.00';
        },
        get persenBelumTercapai() {
            return (100 - this.persenTercapai).toFixed(2);
        }
    }" class="space-y-6">

        <h1 class="text-2xl font-bold mb-4">Input Produksi</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('vendor.laporan.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="bahan_baku" class="block text-sm font-medium">Bahan Baku</label>
                    <select name="bahan_baku" id="bahan_baku" class="w-full border rounded p-2" required>
                        <option value="kayu">Kayu</option>
                        <option value="sekam">Sekam</option>
                        <option value="mixing">Mixing</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Mesin 1</label>
                    <input type="number" x-model.number="mesin1" name="mesin_1" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Mesin 2</label>
                    <input type="number" x-model.number="mesin2" name="mesin_2" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Mesin 3</label>
                    <input type="number" x-model.number="mesin3" name="mesin_3" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Mesin Besar</label>
                    <input type="number" x-model.number="mesinBesar" name="mesin_besar" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Hasil Jadi</label>
                    <input type="number" x-model.number="hasilJadi" name="hasil_jadi" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Hasil Cacat</label>
                    <input type="number" x-model.number="hasilCacat" name="hasil_cacat" class="w-full border rounded p-2">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium">Catatan</label>
                    <textarea name="catatan" class="w-full border rounded p-2" rows="3"></textarea>
                </div>
            </div>

            {{-- Kalkulasi otomatis --}}
            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded">
                <div><strong>Total Produksi:</strong> <span x-text="totalProduksi"></span> Kg</div>
                <div><strong>Tercapai:</strong> <span x-text="tercapai"></span> Kg</div>
                <div><strong>Belum Tercapai:</strong> <span x-text="belumTercapai"></span> Kg</div>
                <div><strong>% Tercapai:</strong> <span x-text="persenTercapai"></span>%</div>
                <div><strong>% Belum Tercapai:</strong> <span x-text="persenBelumTercapai"></span>%</div>
            </div>

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
        </form>

        {{-- Table hasil --}}
        <div class="overflow-x-auto">
            <table class="w-full border mt-6 text-sm">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Bahan Baku</th>
                        <th class="p-2">Mesin 1</th>
                        <th class="p-2">Mesin 2</th>
                        <th class="p-2">Mesin 3</th>
                        <th class="p-2">Mesin Besar</th>
                        <th class="p-2">Total</th>
                        <th class="p-2">Tercapai</th>
                        <th class="p-2">Belum Tercapai</th>
                        <th class="p-2">% Tercapai</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $laporan)
                        <tr class="border-t">
                            <td class="p-2">{{ $laporan->tanggal }}</td>
                            <td class="p-2 capitalize">{{ $laporan->bahan_baku }}</td>
                            <td class="p-2">{{ number_format($laporan->mesin_1, 0) }}</td>
                            <td class="p-2">{{ number_format($laporan->mesin_2, 0) }}</td>
                            <td class="p-2">{{ number_format($laporan->mesin_3, 0) }}</td>
                            <td class="p-2">{{ number_format($laporan->mesin_besar, 0) }}</td>
                            <td class="p-2">{{ number_format($laporan->total_produksi, 0) }}</td>
                            <td class="p-2">{{ number_format($laporan->tercapai, 0) }}</td>
                            <td class="p-2">{{ number_format(16000 - $laporan->tercapai, 0) }}</td>
                            <td class="p-2">{{ number_format(($laporan->tercapai / 16000) * 100, 2) }}%</td>
                            <td class="p-2">
                                <form action="{{ route('vendor.laporan.destroy', $laporan->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="p-4 text-center text-gray-500">Belum ada data produksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
