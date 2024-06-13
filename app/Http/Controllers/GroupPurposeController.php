<?php

namespace App\Http\Controllers;

use App\Models\GroupPurpose;
use Illuminate\Http\Request;

class GroupPurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupPurpose = GroupPurpose::latest()->get();
        return view('dashboard.group-purpose.index',\compact('groupPurpose'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('dashboard.group-purpose.form');
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
            'name'=>'required',
            'description'=>'required'
        ]);


        GroupPurpose::create($request->all());


        return \redirect()->route('group-purpose.index')->with(['success'=>'Data Group Tujuan berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupPurpose  $groupPurpose
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPurpose $groupPurpose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupPurpose  $groupPurpose
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPurpose $groupPurpose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupPurpose  $groupPurpose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupPurpose $groupPurpose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupPurpose  $groupPurpose
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPurpose $groupPurpose)
    {
        //
    }
}
