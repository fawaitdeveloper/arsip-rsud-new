<?php

namespace App\Http\Controllers;

use App\Models\GroupPosition;
use Illuminate\Http\Request;

class GroupPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.grup-jabatan.index',[
            'groupPosition' => GroupPosition::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.grup-jabatan.create');
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

        $groupPosition = GroupPosition::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/grup-jabatan')->with('success', 'Grup Jabatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupPosition  $groupPosition
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPosition $groupPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupPosition  $groupPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPosition $groupPosition)
    {
        return view('dashboard.grup-jabatan.edit',[
            'groupPosition' => $groupPosition
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupPosition  $groupPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupPosition $groupPosition)
    {
        $rules = [
            'name' => 'required|max:255',
        ];
        
        //dd($rules);
        $validatedData = $request->validate($rules);
    
        $groupPosition->update($validatedData);
    
        return redirect('/grup-jabatan')->with('success', 'Data Grup Jabatan telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupPosition  $groupPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPosition $grup_jabatan)
    {
        // dd($induk_unit_kerja);
        GroupPosition::destroy($grup_jabatan->id);
        return redirect('/grup-jabatan')->with('success', 'Data berhasil dihapus!');
    }
}
