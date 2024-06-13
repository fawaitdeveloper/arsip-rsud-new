<?php

namespace App\Http\Controllers;

use App\Helpers\FlowHelper;
use App\Helpers\LetterOutHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\Utils;
use App\Http\Resources\LetterOutCollection;
use App\Http\Resources\LetterOutResource;
use App\Libraries\LetterOut as LibrariesLetterOut;
use App\Libraries\LetterOutAgency;
use App\Libraries\LetterOutCircular;
use App\Libraries\LetterOutInvitation;
use App\Models\AttachmentFile;
use App\Models\Employee;
use App\Models\Flow;
use App\Models\JobPosition;
use App\Models\LetterAttribute;
use App\Models\LetterCategory;
use App\Models\LetterFlow;
use App\Models\LetterHistory;
use App\Models\LetterIn;
use App\Models\LetterInHistory;
use App\Models\LetterOut;
use App\Models\LetterOutDetail;
use App\Models\LetterOutHistory;
use App\Models\LetterReceived;
use App\Models\LetterReply;
use App\Models\LetterUrgency;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Stmt\TryCatch;

class LetterOutController extends Controller
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
        $letterOuts = LetterOut::where('job_position_id', auth()->user()->job_position_id)->latest()->get();
        return view('dashboard.letter-out.index', compact('letterOuts'));
    }


    public function getData($request)
    {
        $query = LetterOut::query();

        $query->where('job_position_id', auth()->user()->job_position_id);

        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('about', 'like', '%' . $request->search['value'] . '%')->orWhere('description', 'like', '%' . $request->search['value'] . '%')->orWhere('letter_number', 'like', '%' . $request->search['value'] . '%');
            });
        }

        if ($request->filled('group')) {
            $query->where("group", $request->group);
        }

        if ($request->filled('status')) {
            $query->status($request->status);
        }

        $currentPage = ($request->start / $request->length) + 1;
        $paginate = $query->latest()->paginate($request->length, ['*'], 'paginate', $currentPage);


        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $paginate->total(),
            "recordsFiltered" => $paginate->total(),
            "data" => new LetterOutCollection($paginate)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->type) {
            return abort(403, "Bad Request");
        }
        $positions = LetterOutHelper::getJobPostion($request);
        $letterCategory = LetterCategory::all();
        $letterUrgency = LetterUrgency::all();
        $letterAttribute = LetterAttribute::all();
        $employes = $request->type != "nota-dinas" ? Employee::all() : [];
        return \view('dashboard.letter-out.form', \compact('positions', 'letterUrgency', 'letterCategory', 'letterAttribute', 'employes'));
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
            "letter_number" => "required",
            "about" => "required",
            "description" => "required",
            'job_position_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            if ($request->type == "surat-undangan") {
                LetterOutInvitation::store($request);
            } else if ($request->type == "surat-edaran") {
                LetterOutCircular::store($request);
            } else if ($request->type == "nota-dinas") {
                LetterOutAgency::store($request);
            }
            DB::commit();
            return redirect('/naskah-keluar')->with(['message' => 'Data naskah keluar berhasil ditambahkan']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LetterOut  $letterOut
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $letterOut = LetterOut::with(['attachments', 'urgency', 'attribute', 'category', 'histories', 'details.position', 'details.user'])->where('id', $id)->first();
        if (!$letterOut) {
            return \abort(404, 'Data tidak ditemukan');
        }

        $histories = LetterHistory::where('code', $letterOut->code)->orderBy('id', 'DESC')->get();
        $replies = LetterReply::where("code", $letterOut->code)->get();
        $received = LetterReceived::where("code", $letterOut->code)->get();

        return \view('dashboard.letter-out.show', \compact('letterOut', 'histories', 'replies', 'received'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LetterOut  $letterOut
     * @return \Illuminate\Http\Response
     */
    public function edit(LetterOut $letterOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LetterOut  $letterOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LetterOut $letterOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LetterOut  $letterOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterOut $letterOut)
    {
        //
    }

    public function disposition(Request $request)
    {
        $detail = LetterOutDetail::where('id', $request->id)->first();
        if (!$detail) {
            return abort(404);
        }
        LetterOutDetail::where('id', $request->id)->update([
            'description' => auth()->user()->name . ' melakukan disposisi',
            'user_id' => auth()->user()->id
        ]);
        LetterOutHistory::create([
            'letter_out_id' => $detail->letter_out_id,
            'description' => auth()->user()->name . ' melakukan disposisi',
            'is_read' => false
        ]);

        return redirect()->back()->with(['message' => 'Disposi berhasil']);
    }

    public function receive(Request $request)
    {
        $detail = LetterOutDetail::where('id', $request->id)->first();
        if (!$detail) {
            return abort(404);
        }

        LetterOutDetail::where('id', $request->id)->update([
            'description' => auth()->user()->name . ' menerima surat keluar',
            'user_id' => auth()->user()->id
        ]);

        LetterOutHistory::create([
            'letter_out_id' => $detail->letter_out_id,
            'description' => auth()->user()->name . ' menerima surat keluar',
            'is_read' => false
        ]);


        $letterOut = LetterOut::where('id', $detail->letter_out_id)->first();


        $getAllUser = User::where('job_position_id', auth()->user()->job_position_id)->pluck('id')->toArray();


        $letterIn = LetterIn::create([
            "sender_name" => $letterOut->sender_name,
            "sender_position" => $letterOut->sender_position,
            "sender_instansi" => "",
            "letter_category_id" => $letterOut->letter_category_id,
            "letter_attribute_id" => $letterOut->letter_attribute_id,
            "letter_urgency_id" => $letterOut->letter_urgency_id,
            "letter_number" => $letterOut->letter_number,
            "letter_date" => $letterOut->letter_date,
            "letter_received" => $letterOut->letter_received,
            "about" => $letterOut->about,
            "description" => $letterOut->description,
            "user_id" => $getAllUser,
            "translucent_id" => [],
            "group_purpose_id" => [],
            "letter_file" => $letterOut->letter_file,
            "attachment_file_id" => $letterOut->attachment_file_id
        ]);

        LetterInHistory::create([
            'letter_in_id' => $letterIn->id,
            'description' => auth()->user()->name . ' menerima naskah masuk',
            'is_read' => false
        ]);

        return redirect()->back()->with(['message' => 'Terima surat keluar berhasil']);
    }
}
