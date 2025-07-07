@extends('layouts.main')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>
        <form action="{{ route('internal.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="block">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-3">
                <label class="block">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-3">
                <label class="block">No HP</label>
                <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-3">
                <label class="block">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2">
                <small class="text-gray-500">Kosongkan jika tidak ingin mengubah password</small>
            </div>
            <div class="mb-3">
                <label class="block">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label class="block">Tipe User</label>
                <select name="tipe_user" class="w-full border rounded p-2" required>
                    <option value="internal_hbl" {{ $user->tipe_user == 'internal_hbl' ? 'selected' : '' }}>Internal
                    </option>
                    <option value="vendor" {{ $user->tipe_user == 'vendor' ? 'selected' : '' }}>Vendor</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection
