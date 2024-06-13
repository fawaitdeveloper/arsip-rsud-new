<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\MainPosition;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jabatan.index',[
            'position' => Position::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workUnit = WorkUnit::all();
        $mainPosition = MainPosition::all();
        return view('dashboard.jabatan.create', [
            'workUnit' => $workUnit,
            'mainPosition' => $mainPosition
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
            'work_unit_id' => 'required',
            'main_position_id' => 'required',
        ]);

        $position = Position::create([
            'name' => $request->input('name'),
            'work_unit_id' => $request->input('work_unit_id'),
            'main_position_id' => $request->input('main_position_id'),
            'isActive' => true,
        ]);

        return redirect('/jabatan')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
    }
}
