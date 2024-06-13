<?php

namespace App\Http\Controllers;

use App\Http\Resources\LetterAttributeCollection;
use App\Models\LetterAttribute;
use Illuminate\Http\Request;

class LetterAttributeController extends Controller
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
        return view('dashboard.letter-attribute.index');
    }

    public function getData($request)
    {
        $query = LetterAttribute::query();

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
            "data" => new LetterAttributeCollection($paginate)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.letter-attribute.form');
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


        LetterAttribute::create($request->all());


        return redirect()->route('letter-attribute.index')->with(['success' => 'Data berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LetterAttribute  $letterAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(LetterAttribute $letterAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LetterAttribute  $letterAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(LetterAttribute $letterAttribute)
    {
        $id = $letterAttribute->id;
        return view('dashboard.letter-attribute.form', compact('id', 'letterAttribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LetterAttribute  $letterAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LetterAttribute $letterAttribute)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $letterAttribute->update($request->all());

        return redirect()->route('letter-attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LetterAttribute  $letterAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterAttribute $letterAttribute)
    {
        $letterAttribute->delete();

        return redirect()->route('letter-attribute.index');
    }
}
