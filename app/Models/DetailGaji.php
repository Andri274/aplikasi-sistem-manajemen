<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailGaji extends Model
{
    protected $fillable = [
        'slip_gaji_id',
        'nama_komponen',
        'nilai',
        'jumlah',
        'keterangan',
        'tipe',
    ];

    public function slipGaji()
    {
        return $this->belongsTo(SlipGaji::class);
    }
}
