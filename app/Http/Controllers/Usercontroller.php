<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');

        if ($role) {
            // Pakai Spatie untuk ambil user sesuai role
            $user = User::role($role)->get();
        } else {
            $user = User::all();
        }

        return view('user', compact('user'));
    }

    public function destroy(string $id)
    {
        try {
            User::where('id', $id)->delete();
            return redirect('/user')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/user')->with('error', 'Data tidak dapat dihapus karena sedang digunakan.');
        }
    }
}
