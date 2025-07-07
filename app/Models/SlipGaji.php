<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SlipGaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'periode_mulai',
        'periode_selesai',
        'total_pendapatan',
        'total_potongan',
        'total_bersih',
        'rekening',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function detailGajis()
    {
        return $this->hasMany(DetailGaji::class);
    }
}
