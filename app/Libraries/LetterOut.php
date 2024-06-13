<?php

namespace App\Libraries;

use App\Helpers\FlowHelper;
use App\Helpers\LetterOutHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\Utils;
use App\Models\AttachmentFile;
use App\Models\Flow;
use App\Models\LetterHistory;
use App\Models\LetterIn;
use App\Models\LetterOut as LetterOutModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LetterOut
{
    public function store(Request $request)
    {
        # code...
        $letterFileName = null;
        if ($request->hasFile('letter_file')) {
            $letterFileName = Utils::singelUpload('letter', $request->file('letter_file'));
        }

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


        if ($request->sender_type == "melalui") {
            $flow = new FlowHelper();
            $flow2 = new FlowHelper();
            foreach ($request->job_position_id as $item) {
                $allData = $flow2->where(auth()->user()->job_position_id, $item)->unique()->sortBy()->get();
                $dataLimit = $flow->where(auth()->user()->job_position_id, $item)->unique()->sortBy()->limit(1);
                $code = LetterOutHelper::generateNumber();
                $fileNames = $this->createFile($request, $code, $allData, $attachmentFileId);
                $this->storeFlow($allData, $code);
                $this->melaluiv2($request, $fileNames, $attachmentFileId, $code, $dataLimit);
            }
        } else {
            $this->mengetahui($request, $letterFileName, $attachmentFileId);
        }
    }

    private function createFile($request, $code, $flow, $attachmentFileId)
    {
        $fileName = 'uploads/letter/' . $code . '.pdf';
        $pdf = Pdf::loadView('dashboard.template-naskah.nota-dinas', [
            'flow' => $flow,
            'request' => $request,
            'attachmentFile' => $attachmentFileId
        ])->save($fileName);
        return $fileName;
    }

    private function storeFlow($flow, $code)
    {
        foreach ($flow['flow'] as $index => $item) {
            Flow::create([
                'sender_position_id' => $item['id'],
                'sender_position_name' => $item['name'],
                'receiver_position_id' => $item['parent_id'],
                'receiver_position_name' => $item['parent_name'],
                'number' => $item['number'],
                'access' => $item['access'],
                'status' => 'haloo',
                'code' => $code,
                'is_store' => $index == 0 ? 1 : 0
            ]);
        }
    }

    private function melaluiv2($request, $letterFileName, $attachmentFileId, $code, $flow)
    {
        foreach ($flow['flow'] as $item) {
            $data = [
                'letter_category_id' => $request->letter_category_id,
                'letter_attribute_id' => $request->letter_attribute_id,
                'letter_urgency_id' => $request->letter_urgency_id,
                'sender_name' => auth()->user()->name ?? "",
                'sender_position' => $flow['sender'],
                'receive_position' => $flow['receiver'],
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
                'job_position_id' => $item['id'],
                'access' => $item['access']
            ];
            LetterOutModel::create($data);
            LetterHistory::create([
                'code' => $code,
                'description' => $item['name'] . ' membuat naskah keluar dengan code ' . $code,
                'is_read' => false
            ]);

            $data = [
                'letter_category_id' => $request->letter_category_id,
                'letter_attribute_id' => $request->letter_attribute_id,
                'letter_urgency_id' => $request->letter_urgency_id,
                'sender_name' => auth()->user()->name ?? "",
                'sender_position' => $flow['sender'],
                'receive_position' => $flow['receiver'],
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
                'job_position_id' => $item['parent_id'],
                'access' => $item['access']
            ];
            LetterIn::create($data);
            LetterHistory::create([
                'code' => $code,
                'description' => $item['parent_name'] . ' menerima naskah masuk dengan code ' . $code,
                'is_read' => false
            ]);

            NotificationHelper::send($item['parent_id'], 'Surat Masuk', 'Kamu menerima surat masuk dari ' . $item['name']);
        }
    }

    public function melalui($request, $letterFileName, $attachmentFileId)
    {
        foreach ($request->job_position_id as $item) {
            $getFlow = LetterOutHelper::getPositionFlow(auth()->user()->job_position_id, $item, $request->sender_type)->toArray();
            $code = LetterOutHelper::generateNumber();

            foreach ($getFlow as $index => $flow) {
                if ($index == 0) {
                    $data = [
                        'letter_category_id' => $request->letter_category_id,
                        'letter_attribute_id' => $request->letter_attribute_id,
                        'letter_urgency_id' => $request->letter_urgency_id,
                        'sender_name' => auth()->user()->name ?? "",
                        'sender_position' => $flow['name'],
                        'sender_instansi' => '',
                        'letter_number' => $request->letter_number,
                        'letter_date' => date('Y-m-d'),
                        'letter_received' => date('Y-m-d'),
                        'letter_file' => $request->hasFile('letter_file') ? $letterFileName : null,
                        'type' => $request->sender_type,
                        'about' => $request->about,
                        'description' => $request->description,
                        "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
                        'letter_refrency_id' => null,
                        'code' => $code,
                        'job_position_id' => $flow['id'],
                        'access' => $flow['access']
                    ];
                    LetterOutModel::create($data);
                    LetterHistory::create([
                        'code' => $code,
                        'description' => $flow['name'] . ' membuat naskah keluar dengan code ' . $code,
                        'is_read' => false
                    ]);
                    $getFlow[$index]['complete'] = true;
                } else {
                    if ($flow['access'] == "R") {
                        $data = [
                            'letter_category_id' => $request->letter_category_id,
                            'letter_attribute_id' => $request->letter_attribute_id,
                            'letter_urgency_id' => $request->letter_urgency_id,
                            'sender_name' => auth()->user()->name ?? "",
                            'sender_position' => $flow['name'],
                            'sender_instansi' => '',
                            'letter_number' => $request->letter_number,
                            'letter_date' => date('Y-m-d'),
                            'letter_received' => date('Y-m-d'),
                            'letter_file' => $request->hasFile('letter_file') ? $letterFileName : null,
                            'type' => $request->sender_type,
                            'about' => $request->about,
                            'description' => $request->description,
                            "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
                            'letter_refrency_id' => null,
                            'code' => $code,
                            'job_position_id' => $flow['id'],
                            'access' => $flow['access']
                        ];
                        LetterIn::create($data);
                        LetterHistory::create([
                            'code' => $code,
                            'description' => $flow['name'] . ' menerima naskah masuk dengan code ' . $code,
                            'is_read' => false
                        ]);
                        $getFlow[$index]['complete'] = true;
                    } else {
                        $data = [
                            'sender_name' => auth()->user()->name ?? "",
                            'sender_position' => $flow['name'],
                            'sender_instansi' => '',
                            'letter_category_id' => $request->letter_category_id,
                            'letter_attribute_id' => $request->letter_attribute_id,
                            'letter_urgency_id' => $request->letter_urgency_id,
                            'letter_number' => $request->letter_number,
                            'letter_date' => date('Y-m-d'),
                            'letter_received' => date('Y-m-d'),
                            'about' => $request->about,
                            'description' => $request->description,
                            'user_id' => null,
                            'letter_file' => $request->hasFile('letter_file') ? $letterFileName : null,
                            'type' => $request->sender_type,
                            "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
                            'letter_refrency_id' => null,
                            'code' => $code,
                            "translucent_id" => null,
                            "group_purpose_id" => null,
                            'job_position_id' => $flow['id'],
                            'access' => $flow['access']
                        ];
                        LetterIn::create($data);
                        LetterHistory::create([
                            'code' => $code,
                            'description' => $flow['name'] . ' menerima naskah masuk dengan code ' . $code,
                            'is_read' => false
                        ]);
                        $getFlow[$index]['complete'] = true;
                        break;
                    }
                }
            }

            LetterOutHelper::storeGetFlow($code, $getFlow);
        }
    }

    public function mengetahui($request, $letterFileName, $attachmentFileId)
    {
        foreach ($request->job_position_id as $item) {
            $getFlow = LetterOutHelper::getPositionFlow(auth()->user()->job_position_id, $item, $request->sender_type)->toArray();
            $code = LetterOutHelper::generateNumber();

            foreach ($getFlow as $index => $flow) {
                if ($index == 0) {
                    $data = [
                        'letter_category_id' => $request->letter_category_id,
                        'letter_attribute_id' => $request->letter_attribute_id,
                        'letter_urgency_id' => $request->letter_urgency_id,
                        'sender_name' => auth()->user()->name ?? "",
                        'sender_position' => $flow['name'],
                        'sender_instansi' => '',
                        'letter_number' => $request->letter_number,
                        'letter_date' => date('Y-m-d'),
                        'letter_received' => date('Y-m-d'),
                        'letter_file' => $request->hasFile('letter_file') ? $letterFileName : null,
                        'type' => $request->sender_type,
                        'about' => $request->about,
                        'description' => $request->description,
                        "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
                        'letter_refrency_id' => null,
                        'code' => $code,
                        'job_position_id' => $flow['id'],
                        'access' => $flow['access']
                    ];
                    LetterOutModel::create($data);
                    LetterHistory::create([
                        'code' => $code,
                        'description' => $flow['name'] . ' membuat naskah keluar dengan code ' . $code,
                        'is_read' => false
                    ]);
                    $getFlow[$index]['complete'] = true;
                } else {
                    if (count($getFlow) == $index) {
                        $data = [
                            'letter_category_id' => $request->letter_category_id,
                            'letter_attribute_id' => $request->letter_attribute_id,
                            'letter_urgency_id' => $request->letter_urgency_id,
                            'sender_name' => auth()->user()->name ?? "",
                            'sender_position' => $flow['name'],
                            'sender_instansi' => '',
                            'letter_number' => $request->letter_number,
                            'letter_date' => date('Y-m-d'),
                            'letter_received' => date('Y-m-d'),
                            'letter_file' => $request->hasFile('letter_file') ? $letterFileName : null,
                            'type' => $request->sender_type,
                            'about' => $request->about,
                            'description' => $request->description,
                            "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
                            'letter_refrency_id' => null,
                            'code' => $code,
                            'job_position_id' => $flow['id'],
                            'access' => "RT"
                        ];
                        LetterIn::create($data);
                        LetterHistory::create([
                            'code' => $code,
                            'description' => $flow['name'] . ' menerima naskah masuk dengan code ' . $code,
                            'is_read' => false
                        ]);
                        $getFlow[$index]['complete'] = true;
                    } else {
                        $data = [
                            'sender_name' => auth()->user()->name ?? "",
                            'sender_position' => $flow['name'],
                            'sender_instansi' => '',
                            'letter_category_id' => $request->letter_category_id,
                            'letter_attribute_id' => $request->letter_attribute_id,
                            'letter_urgency_id' => $request->letter_urgency_id,
                            'letter_number' => $request->letter_number,
                            'letter_date' => date('Y-m-d'),
                            'letter_received' => date('Y-m-d'),
                            'about' => $request->about,
                            'description' => $request->description,
                            'user_id' => null,
                            'letter_file' => $request->hasFile('letter_file') ? $letterFileName : null,
                            'type' => $request->sender_type,
                            "attachment_file_id" => $request->hasFile('attachment_file') ? $attachmentFileId : null,
                            'letter_refrency_id' => null,
                            'code' => $code,
                            "translucent_id" => null,
                            "group_purpose_id" => null,
                            'job_position_id' => $flow['id'],
                            'access' => "R"
                        ];
                        LetterIn::create($data);
                        LetterHistory::create([
                            'code' => $code,
                            'description' => $flow['name'] . ' menerima naskah masuk dengan code ' . $code,
                            'is_read' => false
                        ]);
                        $getFlow[$index]['complete'] = true;
                    }
                }
            }

            LetterOutHelper::storeGetFlow($code, $getFlow);
        }
    }
}
