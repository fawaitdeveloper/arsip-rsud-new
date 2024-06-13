<?php


namespace App\Libraries;

use App\Helpers\LetterOutHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\Utils;
use App\Models\AttachmentFile;
use App\Models\Employee;
use App\Models\JobPosition;
use App\Models\LetterAttribute;
use App\Models\LetterCategory;
use App\Models\LetterEmployee;
use App\Models\LetterHistory;
use App\Models\LetterIn;
use App\Models\LetterOut;
use App\Models\LetterUrgency;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LetterOutInvitation
{
    public static function store(Request $request)
    {
        $attachmentFileId = static::attachmentFiles($request);
        $code = LetterOutHelper::generateNumber();
        $letterFileName = static::createPdfDocument($request, $code, $attachmentFileId);
        $jobPositions = static::getJobPosition($request)->pluck("name")->toArray();
        $data = [
            'letter_category_id' => $request->letter_category_id,
            'letter_attribute_id' => $request->letter_attribute_id,
            'letter_urgency_id' => $request->letter_urgency_id,
            'sender_name' => auth()->user()->name ?? "",
            'sender_position' => auth()->user()->jobPosition->name ?? "",
            'receive_position' => join(", ", $jobPositions),
            'sender_instansi' => 'RSUD SOEDIRAN',
            'letter_number' => $request->letter_number,
            'letter_date' => date('Y-m-d'),
            'letter_received' => date('Y-m-d'),
            'letter_file' => $letterFileName,
            'type' => $request->sender_type,
            'about' => $request->about,
            'description' => $request->description,
            "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
            'letter_refrency_id' => null,
            'code' => $code,
            'job_position_id' => auth()->user()->job_position_id ?? "",
            'access' => "R",
            "group" => $request->type
        ];
        LetterOut::create($data);
        LetterHistory::create([
            'code' => $code,
            'description' => auth()->user()->name . ' membuat ' . join(" ", explode("-", $request->type)) . ' dengan code ' . $code,
            'is_read' => false
        ]);

        foreach (static::getJobPosition($request) as $item) {
            $data = [
                'letter_category_id' => $request->letter_category_id,
                'letter_attribute_id' => $request->letter_attribute_id,
                'letter_urgency_id' => $request->letter_urgency_id,
                'sender_name' => auth()->user()->name ?? "",
                'sender_position' => auth()->user()->jobPosition->name ?? "",
                'receive_position' => join(", ", $jobPositions),
                'sender_instansi' => 'RSUD SOEDIRAN',
                'letter_number' => $request->letter_number,
                'letter_date' => date('Y-m-d'),
                'letter_received' => date('Y-m-d'),
                'letter_file' =>  $letterFileName,
                'type' => $request->sender_type,
                'about' => $request->about,
                'description' => $request->description,
                "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
                'letter_refrency_id' => null,
                'code' => $code,
                'job_position_id' => $item->id,
                'access' => "R",
                "group" => $request->type
            ];
            LetterIn::create($data);
            LetterHistory::create([
                'code' => $code,
                'description' => $item->name . ' menerima naskah masuk ' . join(" ", explode("-", $request->type)) . ' dengan code ' . $code,
                'is_read' => false
            ]);

            NotificationHelper::send($item->id, 'Surat Masuk', 'Kamu menerima surat masuk ' . join(" ", explode("-", $request->type)) . ' dari ' . auth()->user()->name);
        }

        if ($request->filled('employee_id')) {
            $employes = [];

            foreach ($request->employee_id as $item) {
                $employes[] = [
                    'employee_id' => $item,
                    'code' => $code
                ];
            }

            LetterEmployee::bulkCreate($employes);
        }
    }

    public static function createPdfDocument($request, $code, $attachmentFileId)
    {
        $fileName = 'uploads/letter/' . $request->type . '-' . $code . '.pdf';
        $data = static::requestToData($request, $attachmentFileId);
        $pdf = Pdf::loadView('dashboard.template-naskah.surat-undangan', $data)->save($fileName);
        return $fileName;
    }

    private static function requestToData(Request $request, $attachmentFileId)
    {
        $jobPosition =  static::getJobPosition($request);
        $employeeId = $request->filled('employee_id') ? $request->employee_id : [];
        $employee = Employee::whereIn('id', $employeeId)->get();


        return [
            "positions" => $jobPosition,
            "request" => $request,
            'attachmentFileId' => $attachmentFileId,
            "attribute" => LetterAttribute::where('id', $request->letter_attribute_id)->first(),
            "urgensi" => LetterUrgency::where('id', $request->letter_urgency_id)->first(),
            "category" => LetterCategory::where('id', $request->letter_category_id)->first(),
            'employes' => $employee
        ];
    }

    private static function getJobPosition(Request $request)
    {
        return JobPosition::whereIn('id', $request->job_position_id)->get();
    }

    private static function attachmentFiles(Request $request)
    {

        $attachmentFileId = [];
        if ($request->hasFile('attachment_file')) {
            $attachmentFileName = Utils::multiplelUpload('attachment', $request->file('attachment_file'));
            foreach ($attachmentFileName as $file) {
                $attachmentFile = AttachmentFile::create([
                    'file' => $file
                ]);

                array_push($attachmentFileId, $attachmentFile->id);
            }
        }

        return $attachmentFileId;
    }

    private static function letterFile(Request $request)
    {
        $letterFileName = null;
        if ($request->hasFile('letter_file')) {
            $letterFileName = Utils::singelUpload('letter', $request->file('letter_file'));
        }
        return $letterFileName;
    }
}
