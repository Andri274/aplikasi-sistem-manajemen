<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->only('login', 'password');
        
        // Deteksi login pakai email atau no_hp
        $fieldType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';

        if (Auth::attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan tipe_user
            switch ($user->tipe_user) {
                case 'vendor':
                    return redirect()->route('vendor.index');

                case 'internal_hbl':
                    return redirect()->route('internal.index');

                case 'freelance':
                    return redirect()->route('freelance.dashboard'); // pastikan ini ada

                default:
                    Auth::logout();
                    return back()->with('error', 'Tipe user tidak dikenali.');
            }
        }

        return back()->with('error', 'Login gagal. Cek kembali data anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
