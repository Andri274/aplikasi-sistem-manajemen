<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['nama', 'alamat', 'no_hp'];

    public function laporanProduksi()
    {
        return $this->hasMany(LaporanProduksiVendor::class);
    }
}
