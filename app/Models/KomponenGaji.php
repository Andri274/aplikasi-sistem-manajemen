<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    public function detailGajis()
    {
        return $this->hasMany(DetailGaji::class);
    }
    
}
