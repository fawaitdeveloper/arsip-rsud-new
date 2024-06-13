<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobPositionCollection;
use App\Models\JobPosition;
use Illuminate\Http\Request;

class JobPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('draw')) {
            return $this->getData($request);
        }

        $jobPositions = JobPosition::with('parent')->latest()->get();
        return view('dashboard.job-position.index', \compact('jobPositions'));
    }

    public function getData($request)
    {
        $query = JobPosition::query();


        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search['value'] . '%');
            });
        }

        $currentPage = ($request->start / $request->length) + 1;
        $query = $query->latest()->paginate($request->length, ['*'], 'paginate', $currentPage);


        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $query->total(),
            "recordsFiltered" => $query->total(),
            "data" => new JobPositionCollection($query)
        ]);
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
     * @param  \App\Models\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosition $jobPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPosition $jobPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobPosition $jobPosition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPosition $jobPosition)
    {
        //
    }
}
