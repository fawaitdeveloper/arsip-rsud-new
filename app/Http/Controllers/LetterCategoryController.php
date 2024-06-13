<?php

namespace App\Http\Controllers;

use App\Http\Resources\LetterCategoryCollection;
use App\Models\LetterCategory;
use Illuminate\Http\Request;

class LetterCategoryController extends Controller
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
        return view('dashboard.letter-category.index');
    }

    public function getData($request)
    {
        $query = LetterCategory::query();

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
            "data" => new LetterCategoryCollection($paginate)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.letter-category.form');
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


        LetterCategory::create($request->all());


        return redirect()->route('letter-category.index')->with(['success' => 'Data berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LetterCategory  $letterCategory
     * @return \Illuminate\Http\Response
     */
    public function show(LetterCategory $letterCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LetterCategory  $letterCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(LetterCategory $letterCategory)
    {
        $id = $letterCategory->id;
        return view('dashboard.letter-category.form', compact('letterCategory', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LetterCategory  $letterCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LetterCategory $letterCategory)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $letterCategory->update($request->all());
        return redirect()->route('letter-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LetterCategory  $letterCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterCategory $letterCategory)
    {
        $letterCategory->delete();

        return redirect()->route('letter-category.index');
    }
}
