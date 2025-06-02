<?php

namespace App\Http\Controllers;

use App\Models\User;

class Usercontroller extends Controller
{
    public function index(){
        $user = User::all();
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
