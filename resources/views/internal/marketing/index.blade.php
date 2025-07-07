@extends('layouts.main')

@section('title', 'Laporan Marketing')

@section('content')
    <div x-data="{
        editMode: false,
        form: {
            id: null,
            tanggal: '',
            nama_customer: '',
            nama_komoditi: '',
            budget: '',
            qty: '',
            source: '',
            price_source: '',
            tracking: '',
            payment_of_terms: '',
            status: ''
        },
        startEdit(data) {
            this.editMode = true;
            this.form = { ...data };
        },
        cancelEdit() {
            this.editMode = false;
            this.form = {
                id: null,
                tanggal: '',
                nama_customer: '',
                nama_komoditi: '',
                budget: '',
                qty: '',
                source: '',
                price_source: '',
                tracking: '',
                payment_of_terms: '',
                status: ''
            };
        }
    }" class="space-y-6">

        {{-- Form Tambah / Edit --}}
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold mb-4" x-text="editMode ? 'Edit Data Marketing' : 'Tambah Data Marketing'"></h2>
            <form :action="editMode ? `/internal/marketing/${form.id}` : '{{ route('internal.marketing.store') }}'" method="POST">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Tanggal</label>
                        <input type="date" name="tanggal" x-model="form.tanggal" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Nama Customer</label>
                        <input type="text" name="nama_customer" x-model="form.nama_customer" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Nama Komoditi</label>
                        <input type="text" name="nama_komoditi" x-model="form.nama_komoditi" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Budget</label>
                        <input type="number" name="budget" x-model="form.budget" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Qty</label>
                        <input type="number" name="qty" x-model="form.qty" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Source</label>
                        <input type="text" name="source" x-model="form.source" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Price Source</label>
                        <input type="number" name="price_source" x-model="form.price_source" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tracking</label>
                        <input type="number" name="tracking" x-model="form.tracking" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Payment Terms</label>
                        <input type="text" name="payment_of_terms" x-model="form.payment_of_terms" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <input type="text" name="status" x-model="form.status" class="w-full border rounded p-2">
                    </div>
                </div>

                <div class="mt-4 flex space-x-2">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        <span x-text="editMode ? 'Update' : 'Simpan'"></span>
                    </button>
                    <template x-if="editMode">
                        <button type="button" @click="cancelEdit()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Batal
                        </button>
                    </template>
                </div>
            </form>
        </div>

        {{-- Table Data --}}
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold mb-4">Data Marketing</h2>
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Customer</th>
                        <th class="px-4 py-2 text-left">Komoditi</th>
                        <th class="px-4 py-2 text-right">Budget</th>
                        <th class="px-4 py-2 text-right">Qty</th>
                        <th class="px-4 py-2 text-right">Margin/Kg</th>
                        <th class="px-4 py-2 text-right">Total Margin</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $item->tanggal }}</td>
                            <td class="px-4 py-2">{{ $item->nama_customer }}</td>
                            <td class="px-4 py-2">{{ $item->nama_komoditi }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($item->budget, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-right">{{ number_format($item->qty, 0, ',', '.') }} Kg</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($item->margin, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-right">
                                Rp {{ number_format($item->margin * $item->qty, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <button
                                    @click="startEdit({ 
                                        id: {{ $item->id }},
                                        tanggal: '{{ $item->tanggal }}',
                                        nama_customer: '{{ $item->nama_customer }}',
                                        nama_komoditi: '{{ $item->nama_komoditi }}',
                                        budget: '{{ $item->budget }}',
                                        qty: '{{ $item->qty }}',
                                        source: '{{ $item->source }}',
                                        price_source: '{{ $item->price_source }}',
                                        tracking: '{{ $item->tracking }}',
                                        payment_of_terms: '{{ $item->payment_of_terms }}',
                                        status: '{{ $item->status }}'
                                    })"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Edit</button>

                                <form action="{{ route('internal.marketing.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin mau hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
