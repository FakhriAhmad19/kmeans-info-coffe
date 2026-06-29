<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'exists:users,username'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'same:password'],
        ], [
            'username.exists' => 'Username tidak terdaftar.',
            'password.min' => 'Password minimal 6 karakter.',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::where('username', $request->username)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('success', 'Password berhasil diubah. Silakan gunakan password baru untuk masuk.');
        }

        return back()->withErrors(['username' => 'Gagal mengubah password.']);
    }
}
