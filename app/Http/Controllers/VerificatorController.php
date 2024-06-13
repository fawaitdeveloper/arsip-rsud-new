<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verificator;
use Illuminate\Http\Request;

class VerificatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verificators = Verificator::latest()->get();
        return \view('dashboard.verificator.index',\compact('verificators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereNotIn('role',['admin'])->latest()->get();
        return view('dashboard.verificator.form',\compact('users'));
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
            'user_id'=>'required'
        ]);

        Verificator::create($request->all());

        return redirect()->route('verificator.index')->with(['success'=>'Daftar verificator berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verificator  $verificator
     * @return \Illuminate\Http\Response
     */
    public function show(Verificator $verificator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Verificator  $verificator
     * @return \Illuminate\Http\Response
     */
    public function edit(Verificator $verificator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Verificator  $verificator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verificator $verificator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verificator  $verificator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verificator $verificator)
    {
        //
    }
}
