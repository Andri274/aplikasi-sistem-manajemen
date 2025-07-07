<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanProduksiWoodpellet extends Model
{
    protected $table = 'laporan_produksi_woodpellets';

    protected $fillable = [
        'vendor_laporan_id', // Foreign key ke LaporanProduksiVendor
        'tanggal',
        'hasil_produksi',
        'target_capaian',
        'penanggung_jawab',
    ];

    // Relasi ke LaporanProduksiVendor
    public function vendorLaporan()
    {
        return $this->belongsTo(LaporanProduksiVendor::class, 'vendor_laporan_id', 'id');
    }
}
