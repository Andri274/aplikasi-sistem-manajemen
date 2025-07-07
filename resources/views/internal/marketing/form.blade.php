@props(['data' => null])
<div>
    <label class="block text-sm font-medium text-gray-600">Tanggal</label>
    <input type="date" name="tanggal" :value="data?.tanggal ?? ''" class="w-full border rounded p-2" required>
</div>
<div>
    <label class="block text-sm font-medium text-gray-600">Nama Customer</label>
    <input type="text" name="nama_customer" :value="data?.nama_customer ?? ''" class="w-full border rounded p-2">
</div>
{{-- Tambahkan input lainnya sama kayak ini --}}
