
@extends('layouts.main')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-4 rounded shadow space-y-4" x-data="{ showAdd: false, showEdit: false, editData: {} }">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Data Karyawan</h1>
            <button @click="showAdd = true" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">➕
                Tambah Karyawan</button>
        </div>

        {{-- Tabel Karyawan --}}
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">#</th>
                    <th class="border px-2 py-1">Nama</th>
                    <th class="border px-2 py-1">NIK</th>
                    <th class="border px-2 py-1">Jabatan</th>
                    <th class="border px-2 py-1">No Rekening</th>
                    <th class="border px-2 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                    <tr>
                        <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                        <td class="border px-2 py-1">{{ $karyawan->nama }}</td>
                        <td class="border px-2 py-1">{{ $karyawan->nik }}</td>
                        <td class="border px-2 py-1">{{ $karyawan->jabatan }}</td>
                        <td class="border px-2 py-1">{{ $karyawan->no_rekening }}</td>
                        <td class="border px-2 py-1 space-x-1">
                            <button @click="showEdit = true; editData = {{ $karyawan }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs">✏️
                                Edit</button>
                            <form action="{{ route('internal.karyawan.destroy', $karyawan) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">🗑️
                                    Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Modal Tambah --}}
        <div x-show="showAdd" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center" x-cloak>
            <div class="bg-white p-4 rounded shadow max-w-md w-full">
                <h2 class="text-lg font-bold mb-3">Tambah Karyawan</h2>
                <form action="{{ route('internal.karyawan.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm">Nama</label>
                        <input type="text" name="nama" class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm">Jabatan</label>
                        <input type="text" name="jabatan" class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm">No Rekening</label>
                        <input type="text" name="no_rekening" class="w-full border rounded px-2 py-1 text-sm">
                    </div>
                     <a href="{{ route('internal.karyawan.import') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                ⬆️ Upload Massal
            </a>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="showAdd = false"
                            class="bg-gray-400 text-white px-3 py-1 rounded">Batal</button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">💾
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div x-show="showEdit" class="modal fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center" x-cloak>
            <div class="bg-white p-4 rounded shadow max-w-md w-full">
                <h2 class="text-lg font-bold mb-3">Edit Karyawan</h2>
                <form :action="'/internal/karyawan/' + editData.id" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm">Nama</label>
                        <input type="text" name="nama" x-model="editData.nama"
                            class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm">NIK</label>
                        <input type="text" name="nik" x-model="editData.nik"
                            class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm">Jabatan</label>
                        <input type="text" name="jabatan" x-model="editData.jabatan"
                            class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm">No Rekening</label>
                        <input type="text" name="no_rekening" :value="editData.no_rekening ?? ''"
                            class="w-full border rounded px-2 py-1 text-sm">
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="showEdit = false"
                            class="bg-gray-400 text-white px-3 py-1 rounded">Batal</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">💾
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection