<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(){
        return view('auth.regist');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek role dan redirect sesuai role
            if ($user->hasRole('admin')) {
            return redirect('/dashboard/admin');
        } elseif ($user->hasRole('mahasiswa')) {
            return redirect('/dashboard/mahasiswa');
        } elseif ($user->hasRole('dosen')) {
            return redirect('/dashboard-dosen');
        } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Role user tidak dikenali.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function register_action_dosen(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'email.unique' => 'Email ini sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        $data =[
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        $user = User::create($data);

        $user->assignRole('dosen');

        return redirect('/dashboard/admin')->with('success', 'Berhasil Menjadi Karyawan');
    }

    public function register_action_mahasiswa(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'email.unique' => 'Email ini sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        $data =[
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        $user = User::create($data);

        $user->assignRole('mahasiswa');

        return redirect('/dashboard/mahasiswa')->with('success', 'Berhasil Menjadi Karyawan');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
