<?php

namespace App\Http\Controllers;

use App\Models\MainPosition;
use Illuminate\Http\Request;

class MainPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.induk-jabatan.index',[
            'mainPosition' => MainPosition::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.induk-jabatan.create');
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
            'name' => 'required|string|max:255',
        ]);

        $mainPosition = MainPosition::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/induk-jabatan')->with('success', 'Induk Jabatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainPosition  $mainPosition
     * @return \Illuminate\Http\Response
     */
    public function show(MainPosition $mainPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainPosition  $mainPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(MainPosition $induk_jabatan)
    {
        return view('dashboard.induk-jabatan.edit',[
            'induk_jabatan' => $induk_jabatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainPosition  $mainPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainPosition $induk_jabatan)
    {
        $rules = [
            'name' => 'required|max:255',
        ];
        
        //dd($rules);
        $validatedData = $request->validate($rules);
    
        $induk_jabatan->update($validatedData);
    
        return redirect('/induk-jabatan')->with('success', 'Data Induk Jabatan telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainPosition  $mainPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainPosition $induk_jabatan)
    {
        MainPosition::destroy($induk_jabatan->id);
        
        return redirect('/induk-jabatan')->with('success', 'Data berhasil dihapus!');
    }
}
