<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    // Override nama tabel karena Laravel bakal nyari 'absensis'
    protected $table = 'absensi';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'keterangan',
    ];

    // Relasi: Absensi milik satu Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
