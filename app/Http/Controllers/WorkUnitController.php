<?php

namespace App\Http\Controllers;

use App\Models\WorkUnit;
use App\Models\MainWorkUnit;
use Illuminate\Http\Request;

class WorkUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.unit-kerja.index',[
            'workUnits' => WorkUnit::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainWorkUnit = MainWorkUnit::all();
        return view('dashboard.unit-kerja.create', [
            'mainWorkUnit' => $mainWorkUnit
        ]);
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
            'abbreviation' => 'required',
            'main_unit_id' => 'required',
            'address' => 'required',
        ]);

        $workUnit = WorkUnit::create([
            'name' => $request->input('name'),
            'abbreviation' => $request->input('abbreviation'),
            'main_unit_id' => $request->input('main_unit_id'),
            'address' => $request->input('address'),
            'isActive' => true,
        ]);

        return redirect('/unit-kerja')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function show(WorkUnit $workUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkUnit $workUnit)
    {
        $mainWorkUnit = MainWorkUnit::all();
        return view('dashboard.unit-kerja.edit',[
            'mainWorkUnit' => $mainWorkUnit,
            'workUnit' => $workUnit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkUnit $workUnit)
    {
        $rules = [
            'name' => 'required|max:255',
            'abbreviation' => 'required',
            'address' => 'required',
            'status' => 'required',
            'main_work_id' => 'required',
        ];
    
        $validatedData = $request->validate($rules);
    
        $workUnit->update($validatedData);
    
        return redirect('/unit-kerja')->with('success', 'Data telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkUnit $workUnit)
    {
        WorkUnit::destroy($workUnit->id);
        return redirect('/unit-kerja')->with('success', 'Data berhasil dihapus!');
    }
}
