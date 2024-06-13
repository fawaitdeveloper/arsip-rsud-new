<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Purpose::latest()->get();
        return view('dashboard.purpose.index',compact('purposes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereNotIn('role',['admin'])->latest()->get();
        $unitWorks = WorkUnit::latest()->get();
        return \view('dashboard.purpose.form',\compact('users', 'unitWorks'));
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
            'work_unit_id'=>'required',
            'user_id'=>'required',
            'type'=>'required'
        ]);

        Purpose::create([
            'work_unit_id'=>$request->work_unit_id,
            'user_id'=>$request->user_id,
            'type'=>$request->type
        ]);

        return \redirect()->route('purpose.index')->with(['success'=>'Data tujuan berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function show(Purpose $purpose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function edit(Purpose $purpose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purpose $purpose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purpose $purpose)
    {
        //
    }
}
