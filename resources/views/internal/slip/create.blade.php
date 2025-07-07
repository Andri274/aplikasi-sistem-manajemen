<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Input Slip Gaji</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow" x-data="slipForm()">
        <h2 class="text-2xl font-bold mb-4">Input Slip Gaji</h2>

        <form action="{{ route('internal.slip.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Nama Karyawan</label>
                    <select name="karyawan_id" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }} - {{ $k->jabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>No. Rekening</label>
                    <input type="text" name="rekening" x-model="rekening"
                        class="w-full border rounded px-3 py-2 mt-1 bg-gray-100">
                </div>

                <div>
                    <label>Periode</label>
                    <div class="flex gap-2">
                        <input type="date" name="periode_mulai" class="border rounded p-2 w-full" required>
                        <input type="date" name="periode_selesai" class="border rounded p-2 w-full" required>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-semibold mt-6">Pendapatan</h3>
            <template x-for="(item, index) in pendapatan" :key="index">
                <div class="border p-4 rounded mb-2 bg-gray-50">
                    <div class="grid grid-cols-6 gap-2">
                        <div class="col-span-2">
                            <input type="text" :name="`pendapatan[${index}][nama_komponen]`"
                                class="w-full border rounded p-2" x-model="item.nama_komponen" :readonly="item.locked">
                        </div>
                        <div>
                            <input type="number" :name="`pendapatan[${index}][jumlah]`"
                                class="w-full border rounded p-2" x-model.number="item.jumlah">
                        </div>
                        <div>
                            <select :name="`pendapatan[${index}][satuan]`" class="w-full border rounded p-2"
                                x-model="item.satuan">
                                <option value="hari">Hari</option>
                                <option value="jam">Jam</option>
                                <option value="shift">Shift</option>
                            </select>
                        </div>
                        <div>
                            <input type="number" :name="`pendapatan[${index}][nilai]`"
                                class="w-full border rounded p-2" x-model.number="item.nilai">
                        </div>
                        <div>
                            <input type="text" :name="`pendapatan[${index}][keterangan]`"
                                class="w-full border rounded p-2" x-model="item.keterangan" required>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        Subtotal: <span x-text="formatRupiah(item.jumlah * item.nilai)"></span>
                    </div>
                </div>
            </template>
            <button type="button" @click="tambahPendapatan()"
                class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded">+ Tambah Komponen</button>

            <div class="mt-4 font-semibold">Total Pendapatan:
                <span x-text="formatRupiah(totalPendapatan())"></span>
            </div>

            <h3 class="text-xl font-semibold mt-6">Potongan</h3>
            <template x-for="(item, index) in potongan" :key="index">
                <div class="border p-4 rounded mb-2 bg-red-50">
                    <div class="grid grid-cols-4 gap-2">
                        <div>
                            <input type="text" :name="`potongan[${index}][nama_komponen]`"
                                class="w-full border rounded p-2" x-model="item.nama_komponen">
                        </div>
                        <div>
                            <input type="number" :name="`potongan[${index}][nilai]`" class="w-full border rounded p-2"
                                x-model.number="item.nilai">
                        </div>
                        <div class="col-span-2">
                            <input type="text" :name="`potongan[${index}][keterangan]`"
                                class="w-full border rounded p-2" x-model="item.keterangan">
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        Jumlah: <span x-text="formatRupiah(item.nilai)"></span>
                    </div>
                </div>
            </template>
            <button type="button" @click="tambahPotongan()"
                class="mt-2 bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">+ Tambah Potongan</button>

            <div class="mt-4 font-semibold">Total Potongan:
                <span x-text="formatRupiah(totalPotongan())"></span>
            </div>

            <div class="mt-4 font-bold text-lg">Gaji Bersih:
                <span x-text="formatRupiah(gajiBersih())"></span>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan Slip
                    Gaji</button>
            </div>

        </form>
        <div class="mt-6">
            <a href="{{ route('internal.karyawan.index') }}"
                class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm px-3 py-1 rounded mb-3">
                ⬅️ Back
            </a>
        </div>


        <!-- ✅ Alpine Script di bawah -->
        <script>
            function slipForm() {
                return {
                    rekening: '',
                    pendapatan: [{
                            nama_komponen: 'Gaji Harian (Gaji Pokok)',
                            jumlah: 0,
                            nilai: 0,
                            satuan: 'hari',
                            keterangan: '',
                            locked: true
                        },
                        {
                            nama_komponen: 'Gaji Lembur',
                            jumlah: 0,
                            nilai: 0,
                            satuan: 'jam',
                            keterangan: '',
                            locked: true
                        }
                    ],
                    potongan: [],
                    tambahPendapatan() {
                        this.pendapatan.push({
                            nama_komponen: '',
                            jumlah: 0,
                            nilai: 0,
                            satuan: 'hari',
                            keterangan: '',
                            locked: false
                        });
                    },
                    tambahPotongan() {
                        this.potongan.push({
                            nama_komponen: '',
                            nilai: 0,
                            keterangan: ''
                        });
                    },
                    totalPendapatan() {
                        return this.pendapatan.reduce((sum, p) => sum + (p.nilai * p.jumlah), 0);
                    },
                    totalPotongan() {
                        return this.potongan.reduce((sum, p) => sum + p.nilai, 0);
                    },
                    gajiBersih() {
                        return this.totalPendapatan() - this.totalPotongan();
                    },
                    formatRupiah(value) {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(value);
                    }
                }
            }
        </script>
</body>

</html>
