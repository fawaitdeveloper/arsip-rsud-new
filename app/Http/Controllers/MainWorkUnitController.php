<?php

namespace App\Http\Controllers;

use App\Models\MainWorkUnit;
use Illuminate\Http\Request;

class MainWorkUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.induk-unit-kerja.index',[
            'mainWorkUnit' => MainWorkUnit::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.induk-unit-kerja.create');
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

        $mainWorkUnit = MainWorkUnit::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/induk-unit-kerja')->with('success', 'Induk Unit Kerja berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainWorkUnit  $mainWorkUnit
     * @return \Illuminate\Http\Response
     */
    public function show(MainWorkUnit $induk_unit_kerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainWorkUnit  $mainWorkUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(MainWorkUnit $induk_unit_kerja)
    {
        return view('dashboard.induk-unit-kerja.edit',[
            'induk_unit_kerja' => $induk_unit_kerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainWorkUnit  $mainWorkUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainWorkUnit $induk_unit_kerja)
    {
        $rules = [
            'name' => 'required|max:255',
        ];
        
        //dd($rules);
        $validatedData = $request->validate($rules);
    
        $induk_unit_kerja->update($validatedData);
    
        return redirect('/induk-unit-kerja')->with('success', 'Data Induk Unit Kerja has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainWorkUnit  $mainWorkUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainWorkUnit $induk_unit_kerja)
    {
        // dd($induk_unit_kerja);
        MainWorkUnit::destroy($induk_unit_kerja->id);
        
        return redirect('/induk-unit-kerja')->with('success', 'Data berhasil dihapus!');
    }
}
