<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi massal (seeder, create, dll)
     */
    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'password',
        'tipe_user', // internal_hbl / vendor
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom yang dikonversi otomatis ke tipe data tertentu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getRoleAttribute()
{
    return $this->tipe_user;
}

}
