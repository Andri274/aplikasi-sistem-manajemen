<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'jabatan',
        'alamat',
        'telepon',
        'no_rekening',
    ];
    public function slipGajis()
{
    return $this->hasMany(SlipGaji::class);
}

}
