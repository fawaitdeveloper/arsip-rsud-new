<?php

namespace App\Http\Controllers;

use App\Models\LetterIn;
use App\Models\LetterOut;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $card = [
            'letterIn' => LetterIn::where('job_position_id', auth()->user()->job_position_id)->count(),
            'letterOut' => LetterOut::where('job_position_id', auth()->user()->job_position_id)->count(),
        ];

        if (auth()->user()->role == "admin") {
            $card =  [
                'userall' => User::count(),
                'admin' => User::where('role', 'admin')->count(),
                'user' => User::where('role', 'user')->count(),
                'secretary' => User::where('role', 'secretary')->count(),
                ...$card
            ];
        }


        return view('dashboard.index', $card);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
