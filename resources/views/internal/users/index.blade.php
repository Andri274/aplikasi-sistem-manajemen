@extends('layouts.main')

@section('title', 'Daftar User')

@section('content')
    <div class="p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Daftar User</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('internal.users.create') }}"
            class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah User</a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">No HP</th>
                        <th class="px-4 py-2 border">Tipe User</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">{{ $user->no_hp }}</td>
                            <td class="px-4 py-2 border capitalize">{{ $user->tipe_user }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('internal.users.edit', $user->id) }}"
                                    class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                                    Edit
                                </a>
                                <form action="{{ route('internal.users.destroy', $user->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus user ini?')"
                                        class="inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center">Tidak ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
