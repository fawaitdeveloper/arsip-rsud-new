<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Signing;
use App\Models\User;
use Illuminate\Http\Request;

class SigningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signing = Signing::latest()->get();
        return \view('dashboard.signing.index',\compact('signing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::latest()->whereNotIn('role',['admin'])->get();
        return view('dashboard.signing.form',\compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|unique:signings,user_id'
        ]);
        $filename = null;
        if($request->hasFile('signature')){
            $filename = Utils::convertToBase64($request->file('signature'));
        }
        Signing::create([
            'user_id'=>$request->user_id,
            'signature'=>$filename
        ]);

        return \redirect()->route('signing.index')->with(['success'=>'Data Penandatangan berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signing  $signing
     * @return \Illuminate\Http\Response
     */
    public function show(Signing $signing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Signing  $signing
     * @return \Illuminate\Http\Response
     */
    public function edit(Signing $signing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signing  $signing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signing $signing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signing  $signing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signing $signing)
    {
        //
    }
}
