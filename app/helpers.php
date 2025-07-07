<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function tanggalIndo($tanggal)
{
    return Carbon::parse($tanggal)->translatedFormat('d M Y');
}

function isInternal() {
    return Auth::check() && Auth::user()->tipe_user === 'internal_hbl';
}

function isVendor()
{
    return Auth::check() && Auth::user()->tipe_user === 'vendor';
}

function isAdmin()
{
    return Auth::check() && Auth::user()->tipe_user === 'internal_hbl';
}
