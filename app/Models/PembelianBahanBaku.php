<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianBahanBaku extends Model
{
    protected $fillable = [
        'tanggal',
        'nama_bahan',
        'jumlah',
        'satuan',
        'harga_satuan',
        'total_harga',
        'supplier',
        'no_faktur',
        'bukti_file',
        'keterangan'
    ];
}
