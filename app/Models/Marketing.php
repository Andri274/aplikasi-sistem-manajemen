<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_customer',
        'nama_komoditi',
        'budget',
        'qty',
        'source',
        'price_source',
        'tracking',
        'payment_of_terms',
        'margin',
        'status'
    ];
}
