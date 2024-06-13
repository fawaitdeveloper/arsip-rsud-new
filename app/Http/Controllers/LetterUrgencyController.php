<?php

namespace App\Http\Controllers;

use App\Http\Resources\LetterUrgencyCollection;
use App\Models\LetterUrgency;
use Illuminate\Http\Request;

class LetterUrgencyController extends Controller
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
        return view('dashboard.letter-urgency.index');
    }

    public function getData($request)
    {
        $query = LetterUrgency::query();

        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search['value'] . '%');
            });
        }

        $currentPage = ($request->start / $request->length) + 1;
        $paginate = $query->paginate($request->length, ['*'], 'paginate', $currentPage);

        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $paginate->total(),
            "recordsFiltered" => $paginate->total(),
            "data" => new LetterUrgencyCollection($paginate)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.letter-urgency.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);


        LetterUrgency::create($request->all());


        return redirect()->route('letter-urgency.index')->with(['success' => 'Data berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LetterUrgency  $letterUrgency
     * @return \Illuminate\Http\Response
     */
    public function show(LetterUrgency $letterUrgency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LetterUrgency  $letterUrgency
     * @return \Illuminate\Http\Response
     */
    public function edit(LetterUrgency $letterUrgency)
    {
        $id = $letterUrgency->id;
        return view('dashboard.letter-urgency.form', compact('letterUrgency', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LetterUrgency  $letterUrgency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LetterUrgency $letterUrgency)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $letterUrgency->update($request->all());

        return redirect()->route('letter-urgency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LetterUrgency  $letterUrgency
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterUrgency $letterUrgency)
    {
        $letterUrgency->delete();
        return redirect()->route('letter-urgency.index');
    }
}
