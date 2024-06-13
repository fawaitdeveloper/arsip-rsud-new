<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        
        return view('login.login');
    }

    //Function login Users
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        // Menambahkan kondisi isActive ke dalam kredensial
        $credentials['isActive'] = true;
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('success', 'Selamat, Anda Berhasil Masuk!');
        }
    
        return back()->with('loginError', 'Username atau password salah atau user tidak aktif!');
    }
    

    //Function logout
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}