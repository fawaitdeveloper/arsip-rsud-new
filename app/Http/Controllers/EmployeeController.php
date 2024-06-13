<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('draw')) {
            return $this->getData($request);
        }

        return view('dashboard.employee.index');
    }

    public function getData($request)
    {
        $query = Employee::query();


        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('nip', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('unit', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('position', 'like', '%' . $request->search['value'] . '%');
            });
        }

        if ($request->filter) {
            if ($request->filter != 'semua') {
                $filter = $request->filter == "selesai" ? true : null;
                $query->where('complete', $filter);
            } else {
                $query->where(function ($query) {
                    $query->where('complete', true)->orWhere('complete', false)->orWhere('complete', null);
                });
            }
        }

        $currentPage = ($request->start / $request->length) + 1;
        $query = $query->latest()->paginate($request->length, ['*'], 'paginate', $currentPage);


        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $query->total(),
            "recordsFiltered" => $query->total(),
            "data" => new EmployeeCollection($query)
        ]);
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            Excel::import(new EmployeeImport, $request->file('file'));

            return redirect()->back()->with(['success' => 'Data berhasil di import']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with(['errors' => $th->getMessage()]);
        }
    }
}
