<?php

namespace App\Http\Controllers;

use App\Models\Translucent;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class TranslucentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translucents = Translucent::latest()->get();
        return view('dashboard.Translucent.index',compact('translucents'));
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
        return \view('dashboard.translucent.form',\compact('users', 'unitWorks'));
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

        Translucent::create([
            'work_unit_id'=>$request->work_unit_id,
            'user_id'=>$request->user_id,
            'type'=>$request->type
        ]);

        return \redirect()->route('translucent.index')->with(['success'=>'Data tujuan berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Translucent  $Translucent
     * @return \Illuminate\Http\Response
     */
    public function show(Translucent $translucent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Translucent  $Translucent
     * @return \Illuminate\Http\Response
     */
    public function edit(Translucent $translucent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Translucent  $Translucent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translucent $translucent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Translucent  $Translucent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Translucent $translucent)
    {
        //
    }
}
