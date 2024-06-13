<?php

namespace App\Http\Controllers;

use App\Helpers\FlowHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\Utils;
use App\Http\Resources\LetterInCollection;
use App\Http\Resources\LetterInResource;
use App\Libraries\Flow as LibrariesFlow;
use App\Libraries\LetterInForward;
use App\Models\AttachmentFile;
use App\Models\Flow;
use App\Models\GroupPurpose;
use App\Models\JobPosition;
use App\Models\LetterAttribute;
use App\Models\LetterCategory;
use App\Models\LetterFlow;
use App\Models\LetterHistory;
use App\Models\LetterIn;
use App\Models\LetterInHistory;
use App\Models\LetterOut;
use App\Models\LetterReceived;
use App\Models\LetterReply;
use App\Models\LetterUrgency;
use App\Models\Translucent;
use App\Models\User;
use Illuminate\Http\Request;

class LetterInController extends Controller
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
        $letterIns = LetterIn::where('job_position_id', auth()->user()->job_position_id)->latest()->get();
        return view('dashboard.letter-in.index', \compact('letterIns'));
    }

    public function getData($request)
    {
        $query = LetterIn::query()->where('job_position_id', '=', auth()->user()->job_position_id);


        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('about', 'like', '%' . $request->search['value'] . '%')->orWhere('description', 'like', '%' . $request->search['value'] . '%')->orWhere('letter_number', 'like', '%' . $request->search['value'] . '%');
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

        if ($request->filled('group')) {
            $query->where("group", $request->group);
        }

        if ($request->filled('status')) {
            $query->status($request->status);
        }

        $currentPage = ($request->start / $request->length) + 1;
        $query = $query->latest()->paginate($request->length, ['*'], 'paginate', $currentPage);


        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $query->total(),
            "recordsFiltered" => $query->total(),
            "data" => new LetterInCollection($query)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $letterCategory = LetterCategory::latest()->get();
        $letterAttribute = LetterAttribute::latest()->get();
        $letterUrgency = LetterUrgency::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        $translucents = Translucent::latest()->get();
        $groupPurposes = GroupPurpose::latest()->get();
        return \view('dashboard.letter-in.form', \compact('letterUrgency', 'letterAttribute', 'letterCategory', 'users', 'translucents', 'groupPurposes'));
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
            "sender_name" => 'required',
            "sender_position" => 'required',
            "sender_instansi" => 'required',
            "letter_category_id" => 'required',
            "letter_attribute_id" => 'required',
            "letter_urgency_id" => 'required',
            "letter_number" => 'required',
            "letter_date" => 'required',
            "letter_received" => 'required',
            "about" => 'required',
            "description" => 'required',
            "user_id" => 'required',
            "translucent_id" => 'required',
            "group_purpose_id" => 'required',
            "letter_file" => "required|file|mimes:pdf",
            "attachment_file.*" => "required|file|mimes:pdf,svg"
        ]);
        try {

            if ($request->hasFile('letter_file')) {
                $letterFileName = Utils::singelUpload('letter', $request->file('letter_file'));
            }

            if ($request->hasFile('attachment_file')) {
                $attachmentFileName = Utils::multiplelUpload('attachment', $request->file('attachment_file'));
                $attachmentFileId = [];
                foreach ($attachmentFileName as $file) {
                    $attachmentFile = AttachmentFile::create([
                        'file' => $file
                    ]);

                    array_push($attachmentFileId, $attachmentFile->id);
                }
            }

            $userIds = $request->user_id ? json_encode(array_map(function ($item) {
                return (int) $item;
            }, $request->user_id)) : null;

            $translucentIds = $request->translucent_id ? json_encode(array_map(function ($item) {
                return (int) $item;
            }, $request->translucent_id)) : null;

            $letterIn = LetterIn::create([
                "sender_name" => $request->sender_name,
                "sender_position" => $request->sender_position,
                "sender_instansi" => $request->sender_instansi,
                "letter_category_id" => $request->letter_category_id,
                "letter_attribute_id" => $request->letter_attribute_id,
                "letter_urgency_id" => $request->letter_urgency_id,
                "letter_number" => $request->letter_number,
                "letter_date" => $request->letter_date,
                "letter_received" => $request->letter_received,
                "about" => $request->about,
                "description" => $request->description,
                "user_id" => $userIds,
                "translucent_id" => $translucentIds,
                "group_purpose_id" => $request->group_purpose_id,
                "letter_file" => $request->hasFile('letter_file') ? $letterFileName : null,
                "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
            ]);

            LetterInHistory::create([
                'letter_in_id' => $letterIn->id,
                'description' => auth()->user()->name . ' membuat naskah masuk',
                'is_read' => false
            ]);

            return redirect()->route('naskah-masuk.index')->with(['success' => 'Data naskah masuk berhasil ditambahkan']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['errors' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LetterIn  $letterIn
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $letterIn = LetterIn::with(['users', 'translucents', 'attachments', 'groupPurpose', 'urgency', 'category', 'attribute', 'history', 'flows'])->where('id', $id)->first();
        if (!$letterIn) {
            return abort(404);
        }
        $flow = $letterIn->flows->where('sender_position_id', auth()->user()->job_position_id)->first();
        $belowPosition = Utils::jobPositions();
        $histories = LetterHistory::where('code', $letterIn->code)->orderBy('id', 'DESC')->get();
        $replies = LetterReply::where("code", $letterIn->code)->get();
        $received = LetterReceived::where("code", $letterIn->code)->get();
        return \view('dashboard.letter-in.show', \compact('letterIn', 'histories', 'flow', 'belowPosition', 'replies', 'received'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LetterIn  $letterIn
     * @return \Illuminate\Http\Response
     */
    public function edit(LetterIn $letterIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LetterIn  $letterIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LetterIn $letterIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LetterIn  $letterIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterIn $letterIn)
    {
        //
    }

    // registration
    public function registration()
    {
        return \view('dashboard.letter-in.registration');
    }

    // kirim naskah masuk
    public function sendLetter(Request $request)
    {
        LetterIn::where('id', $request->id)->update([
            'send_status' => 1
        ]);

        return \redirect()->route('naskah-masuk.index')->with(['message' => 'Nashkah berhasil dikirim']);
    }

    // data naskah masuk utama
    public function utama(Request $request)
    {
        $letterIns = LetterIn::where('send_status', 1)->whereHas('users', function ($q) {
            $q->where('id', auth()->user()->id);
        })->latest()->get();
        return view('dashboard.letter-in.index', \compact('letterIns'));
    }

    public function utamaShow($id)
    {
        $letterIn = LetterIn::with(['users', 'translucents', 'attachments', 'groupPurpose', 'urgency', 'category', 'attribute'])->where('id', $id)->first();
        return \view('dashboard.letter-in.show', \compact('letterIn'));
    }

    public function teruskan(Request $request)
    {
        $request->validate([
            'job_position_id' => 'required'
        ]);
        try {
            LetterInForward::teruskan($request);

            return redirect()->back()->with(['success' => 'Surat berhasil diteruskan']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function disposisi(Request $request)
    {
        try {
            LetterInForward::disposisi($request);

            return redirect()->back()->with(['success' => 'Surat berhasil di disposisi']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function terima(Request $request)
    {
        try {
            LetterInForward::terima($request);

            return redirect()->back()->with(['success' => 'Surat berhasil di terima']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function balas(Request $request)
    {
        try {
            LetterInForward::balas($request);

            return redirect()->back()->with(['success' => 'Surat berhasil di balas']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
