<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $this->authorizeInternal();

        $users = User::all();

        return view('internal.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorizeInternal();

        return view('internal.users.create');
    }

    public function store(Request $request)
    {
        $this->authorizeInternal();

        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'tipe_user' => 'required|in:internal_hbl,vendor',
        ]);

        User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipe_user' => $request->tipe_user,
        ]);

        return redirect()->route('internal.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $this->authorizeInternal();

        return view('internal.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeInternal();

        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'tipe_user' => 'required|in:internal_hbl,vendor',
        ]);

        $user->name = $request->name;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->tipe_user = $request->tipe_user;
        $user->save();

        return redirect()->route('internal.users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $this->authorizeInternal();

        $user->delete();

        return redirect()->route('internal.users.index')->with('success', 'User berhasil dihapus');
    }

    private function authorizeInternal()
    {
        if (Auth::user()->tipe_user !== 'internal_hbl') {
            abort(403, 'Hanya admin internal yang boleh mengakses fitur ini');
        }
    }
}
