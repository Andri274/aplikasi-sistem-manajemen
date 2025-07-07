<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanProduksiVendor extends Model
{
    protected $table = 'laporan_produksi_vendors';

    protected $fillable = [
        'vendor_id', // Pastikan ada kolom vendor_id di tabel
        'tanggal',
        'bahan_baku',
        'qty_bahan_baku',
        'mesin_1',
        'mesin_2',
        'mesin_3',
        'mesin_besar',
        'total_produksi',
        'tercapai',
        'belum_tercapai',
        'waktu_kerja_tim',
        'hasil_jadi',
        'hasil_cacat',
        'catatan',
        'penanggung_jawab',
    ];

    // Relasi ke Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    // Relasi ke Produksi Woodpellet (Opsional jika ada sync)
    public function woodpellet()
    {
        return $this->hasOne(LaporanProduksiWoodpellet::class, 'vendor_laporan_id', 'id');
    }
}
