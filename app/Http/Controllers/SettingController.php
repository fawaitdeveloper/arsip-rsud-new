<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    public function get()
    {
        return view('dashboard.profile-setting.get');
    }


    public function post(Request $request)
    {
        User::where('id', auth()->user()->id)->update($request->except('_token'));

        return redirect()->back()->with(['success' => 'Akun berhasil diperbarui']);
    }
}
