<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    //

    public function get()
    {
        return view('dashboard.reset-password.get');
    }


    public function post(Request $request)
    {
        $request->validate([
            'password_old' => 'required',
            'password_new' => 'required'
        ]);


        if (!Hash::check($request->password_old, auth()->user()->password)) {
            return redirect()->back()->withErrors(['password_old' => 'Password lama tidak valid']);
        }

        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->password_new)
        ]);

        return redirect()->back()->with(['success' => 'Akun berhasil diperbarui']);
    }
}
