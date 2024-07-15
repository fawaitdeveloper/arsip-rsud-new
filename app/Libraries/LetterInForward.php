<?php

namespace App\Libraries;

use App\Helpers\NotificationHelper;
use App\Helpers\Utils;
use App\Models\Flow;
use App\Models\JobPosition;
use App\Models\LetterHistory;
use App\Models\LetterIn;
use App\Models\LetterOut;
use App\Models\LetterReceived;
use App\Models\LetterReply;
use Illuminate\Http\Request;

class LetterInForward
{
    public static function send($flow, Request $request, $letter)
    {
        foreach ($flow as $el) {
            $dataOut = [
                'letter_category_id' => $letter->letter_category_id,
                'letter_attribute_id' => $letter->letter_attribute_id,
                'letter_urgency_id' => $letter->letter_urgency_id,
                'sender_name' => auth()->user()->name ?? "",
                'sender_position' => auth()->user()->jobPosition->name ?? "",
                'receive_position' => $el['name'],
                'sender_instansi' => 'RSUD SOEDIRAN',
                'letter_number' => $letter->letter_number,
                'letter_date' => date('Y-m-d'),
                'letter_received' => null,
                'letter_file' => $letter->letter_file,
                'type' => $letter->sender_type,
                'about' => $letter->about,
                'description' => $letter->description,
                "attachment_file_id" => $letter->attachment_file_id,
                'letter_refrency_id' => null,
                'code' => $request->code,
                'job_position_id' => auth()->user()->job_position_id ?? "",
                'access' => "T",
                "group" => $letter->group
            ];

            LetterHistory::create([
                'code' => $request->code,
                'description' => auth()->user()->jobPosition->name . ' meneruskan naskah masuk ' . join(" ", explode("-", $letter->group)) . ' kepada ' . $el['name'] . ' dengan code ' . $request->code,
                'is_read' => false
            ]);

            LetterOut::create($dataOut);


            $dataIn = [
                'letter_category_id' => $letter->letter_category_id,
                'letter_attribute_id' => $letter->letter_attribute_id,
                'letter_urgency_id' => $letter->letter_urgency_id,
                'sender_name' => auth()->user()->name ?? "",
                'sender_position' => auth()->user()->jobPosition->name ?? "",
                'receive_position' => $el['name'],
                'sender_instansi' => 'RSUD SOEDIRAN',
                'letter_number' => $letter->letter_number,
                'letter_date' => date('Y-m-d'),
                'letter_received' => null,
                'letter_file' =>  $letter->letter_file,
                'type' => $letter->sender_type,
                'about' => $letter->about,
                'description' => $letter->description,
                "attachment_file_id" => $letter->attachment_file_id,
                'letter_refrency_id' => null,
                'code' => $request->code,
                'job_position_id' => $el['id'],
                'access' => "T",
                "group" => $letter->group,
                'receive_id' => $request->receive_position_id
            ];

            LetterIn::create($dataIn);
            LetterHistory::create([
                'code' => $request->code,
                'description' => $el['name'] . ' menerima naskah masuk ' . join(" ", explode("-", $letter->type)) . ' dari ' . auth()->user()->jobPosition->name . ' dengan code ' . $request->code,
                'is_read' => false
            ]);

            NotificationHelper::send($el['id'], 'Surat Masuk', 'Kamu menerima surat masuk ' . join(" ", explode("-", $letter->group)) . ' dari ' . auth()->user()->name);

            break;
        }
    }

    public static function disposisi(Request $request)
    {
        $letter = LetterIn::where("job_position_id", auth()->user()->job_position_id)->where("code", $request->code)->first();

        $first = Flow::where("job_position_id", auth()->user()->job_position_id)->where("receive_position_id", $letter->receive_id)->first();
        $last = Flow::where("receive_position_id", $letter->receive_id)->where("number", $first->number + 1)->first();

        $dataOut = [
            'letter_category_id' => $letter->letter_category_id,
            'letter_attribute_id' => $letter->letter_attribute_id,
            'letter_urgency_id' => $letter->letter_urgency_id,
            'sender_name' => auth()->user()->name ?? "",
            'sender_position' => auth()->user()->jobPosition->name ?? "",
            'receive_position' => $last->job_position_name,
            'sender_instansi' => 'RSUD SOEDIRAN',
            'letter_number' => $letter->letter_number,
            'letter_date' => date('Y-m-d'),
            'letter_received' => null,
            'letter_file' => $letter->letter_file,
            'type' => $letter->sender_type,
            'about' => $letter->about,
            'description' => $letter->description,
            "attachment_file_id" => $letter->attachment_file_id,
            'letter_refrency_id' => null,
            'code' => $request->code,
            'job_position_id' => auth()->user()->job_position_id ?? "",
            'access' => $first->access,
            "group" => $letter->group
        ];

        LetterHistory::create([
            'code' => $request->code,
            'description' => auth()->user()->jobPosition->name . ' melakukan disposisi naskah masuk ' . join(" ", explode("-", $letter->group)) . ' kepada ' . $last->job_position_name . ' dengan code ' . $request->code,
            'is_read' => false
        ]);

        LetterOut::create($dataOut);


        $dataIn = [
            'letter_category_id' => $letter->letter_category_id,
            'letter_attribute_id' => $letter->letter_attribute_id,
            'letter_urgency_id' => $letter->letter_urgency_id,
            'sender_name' => auth()->user()->name ?? "",
            'sender_position' => auth()->user()->jobPosition->name ?? "",
            'receive_position' => $last->job_position_name,
            'sender_instansi' => 'RSUD SOEDIRAN',
            'letter_number' => $letter->letter_number,
            'letter_date' => date('Y-m-d'),
            'letter_received' => null,
            'letter_file' =>  $letter->letter_file,
            'type' => $letter->sender_type,
            'about' => $letter->about,
            'description' => $letter->description,
            "attachment_file_id" => $letter->attachment_file_id,
            'letter_refrency_id' => null,
            'code' => $request->code,
            'job_position_id' => $last->job_position_id,
            'access' => $last->access,
            "group" => $letter->group,
            'receive_id' => $letter->receive_id
        ];

        LetterIn::create($dataIn);
        LetterHistory::create([
            'code' => $request->code,
            'description' => $last->job_position_name . ' menerima naskah masuk ' . join(" ", explode("-", $letter->type)) . ' dari ' . auth()->user()->jobPosition->name . ' dengan code ' . $request->code,
            'is_read' => false
        ]);

        NotificationHelper::send($last->job_position_id, 'Surat Masuk', 'Kamu menerima surat masuk ' . join(" ", explode("-", $letter->group)) . ' dari ' . auth()->user()->jobPosition->name);

        LetterIn::where("id", $letter->id)->update([
            'is_broadcast' => true
        ]);

        Flow::where("id", $first->id)->update([
            'is_store' => true
        ]);
    }

    public static function terima(Request $request)
    {
        $letter = LetterIn::where("job_position_id", auth()->user()->job_position_id)->where("code", $request->code)->first();
        LetterIn::where("id", $letter->id)->update([
            'access' => 'B',
            'letter_received' => date("Y-m-d")
        ]);


        LetterHistory::create([
            'code' => $request->code,
            'description' =>  ' Surat telah diterima oleh ' . auth()->user()->jobPosition->name . ' dengan code ' . $request->code,
            'is_read' => false
        ]);

        // LetterIn::where("code", $request->code)->update([
        //     'receive_name' => Utils::joinReceived($letter->receive_name, auth()->user()->name),
        //     'receive_position' => Utils::joinReceived($letter->receive_position, auth()->user()->jobPosition->name),
        // ]);

        // LetterOut::where("code", $request->code)->update([
        //     'receive_name' => Utils::joinReceived($letter->receive_name, auth()->user()->name),
        //     'receive_position' => Utils::joinReceived($letter->receive_position, auth()->user()->jobPosition->name),
        // ]);
        LetterReceived::create([
            'name' => auth()->user()->name,
            'position' => auth()->user()->jobPosition->name,
            'code' => $request->code
        ]);
    }

    public static function balas(Request $request)
    {
        $letter = LetterIn::where("job_position_id", auth()->user()->job_position_id)->where("code", $request->code)->first();
        LetterReply::create([
            'code' => $request->code,
            'position' => auth()->user()->jobPosition->name,
            'description' => $request->description
        ]);

        LetterHistory::create([
            'code' => $request->code,
            'description' => auth()->user()->jobPosition->name . ' membalas surat dengan code ' . $request->code,
            'is_read' => false
        ]);

        LetterIn::where("id", $letter->id)->update([
            'access' => 'TT'
        ]);
    }

    public static function teruskan($request)
    {
        $letterIn = LetterIn::where("code", $request->code)->where("job_position_id", auth()->user()->job_position_id)->first();
        $jobPositions = static::getJobPosition($request)->pluck("name")->toArray();
        $data = [
            'letter_category_id' => $letterIn->letter_category_id,
            'letter_attribute_id' => $letterIn->letter_attribute_id,
            'letter_urgency_id' => $letterIn->letter_urgency_id,
            'sender_name' => auth()->user()->name ?? "",
            'sender_position' => auth()->user()->jobPosition->name ?? "",
            'receive_position' => join(", ", $jobPositions),
            'sender_instansi' => 'RSUD SOEDIRAN',
            'letter_number' => $letterIn->letter_number,
            'letter_date' => date('Y-m-d'),
            'letter_received' => date('Y-m-d'),
            'letter_file' => $letterIn->letter_file,
            'type' => $letterIn->type,
            'about' => $letterIn->about,
            'description' => $letterIn->description,
            "attachment_file_id" => $letterIn->attachment_file_id,
            'letter_refrency_id' => null,
            'code' => $request->code,
            'job_position_id' => auth()->user()->job_position_id ?? "",
            'access' => "R",
            "group" => $letterIn->group,
            'note'=>$request->note
        ];

        LetterOut::create($data);
        LetterHistory::create([
            'code' => $request->code,
            'description' => auth()->user()->jobPosition->name . ' meneruskan surat' . join(" ", explode("-", $letterIn->type)) . ' dengan code ' . $request->code,
            'is_read' => false
        ]);

        foreach ($request->job_position_id as $item) {
            $data = [
                'letter_category_id' => $letterIn->letter_category_id,
                'letter_attribute_id' => $letterIn->letter_attribute_id,
                'letter_urgency_id' => $letterIn->letter_urgency_id,
                'sender_name' => auth()->user()->name ?? "",
                'sender_position' => auth()->user()->jobPosition->name ?? "",
                'receive_position' => join(", ", $jobPositions),
                'sender_instansi' => 'RSUD SOEDIRAN',
                'letter_number' => $letterIn->letter_number,
                'letter_date' => date('Y-m-d'),
                'letter_received' => date('Y-m-d'),
                'letter_file' =>  $letterIn->letter_file,
                'type' => $letterIn->type,
                'about' => $letterIn->about,
                'description' => $letterIn->description,
                "attachment_file_id" => $letterIn->attachment_file_id,
                'letter_refrency_id' => null,
                'code' => $request->code,
                'job_position_id' => $item,
                'access' => "F",
                "group" => $letterIn->group,
                'note'=>$request->note
            ];
            $jobPosition = JobPosition::where("id", $item)->first();
            LetterIn::create($data);
            LetterHistory::create([
                'code' => $request->code,
                'description' => $jobPosition->name . ' menerima naskah masuk ' . join(" ", explode("-", $letterIn->type)) . ' dengan code ' . $request->code,
                'is_read' => false
            ]);

            NotificationHelper::send($item, 'Surat Masuk', 'Kamu menerima surat masuk ' . join(" ", explode("-", $letterIn->type)) . ' dari ' . auth()->user()->jobPosition->name);
        }

        LetterIn::where("id", $letterIn->id)->update([
            'is_broadcast' => true
        ]);
    }

    private static function getJobPosition(Request $request)
    {
        return JobPosition::whereIn('id', $request->job_position_id)->get();
    }
}
