<?php

namespace App\Http\Controllers;

use App\Models\JobLevel;
use Illuminate\Http\Request;

class JobLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobLevels = JobLevel::latest()->get();
        return view('dashboard.job-level.index',\compact('jobLevels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobLevel  $jobLevel
     * @return \Illuminate\Http\Response
     */
    public function show(JobLevel $jobLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobLevel  $jobLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(JobLevel $jobLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobLevel  $jobLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobLevel $jobLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobLevel  $jobLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobLevel $jobLevel)
    {
        //
    }
}
