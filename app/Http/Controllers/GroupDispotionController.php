<?php

namespace App\Http\Controllers;

use App\Models\GroupDispotion;
use Illuminate\Http\Request;

class GroupDispotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupDisposition = GroupDispotion::latest()->get();
        return \view('dashboard.group-disposition.index',\compact('groupDisposition'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('dashboard.group-disposition.form');
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
            'name'=>'required'
        ]);

        GroupDispotion::create($request->all());


        return \redirect()->route('group-disposition.index')->with(['success'=>'Data Group Disiposisi berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupDispotion  $groupDispotion
     * @return \Illuminate\Http\Response
     */
    public function show(GroupDispotion $groupDispotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupDispotion  $groupDispotion
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupDispotion $groupDispotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupDispotion  $groupDispotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupDispotion $groupDispotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupDispotion  $groupDispotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupDispotion $groupDispotion)
    {
        //
    }
}
