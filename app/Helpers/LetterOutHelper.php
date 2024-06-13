<?php

namespace App\Helpers;

use App\Models\JobPosition;
use App\Models\LetterFlow;
use App\Models\LetterIn;
use App\Models\LetterOut;
use Illuminate\Http\Request;

class LetterOutHelper
{
    public static function getPositionFlow($from, $to, $type)
    {
        $findFrom = JobPosition::with('parent')->where('id', $from)->first();
        $findTo = JobPosition::where('id', $to)->first();

        $data = collect([]);

        switch (true) {
                // jika tujuan direktur atau pengirim direktur (done)
            case $findTo->id == 1 || $findFrom->id == 1:
                $data->push([
                    'id' => $findFrom->id,
                    'name' => $findFrom->name,
                    'step' => 1,
                    'status' => 'sender',
                    'prefix' => false,
                    'access' => 'R',
                    'complete' => false
                ]);
                $data->push([
                    'id' => $findTo->id,
                    'name' => $findTo->name,
                    'step' => 3,
                    'status' => 'receiver',
                    'prefix' => false,
                    'access' => 'RT',
                    'complete' => false
                ]);
                break;
                // jika data parent pengirim dan penerima sama (done)
            case $findFrom->parent_id == $findTo->id || $findFrom->id == $findTo->parent_id:
                $data->push([
                    'id' => $findFrom->id,
                    'name' => $findFrom->name,
                    'step' => 1,
                    'status' => 'sender',
                    'prefix' => false,
                    'access' => 'R',
                    'complete' => false
                ]);
                $data->push([
                    'id' => $findTo->id,
                    'name' => $findTo->name,
                    'step' => 3,
                    'status' => 'receiver',
                    'prefix' => false,
                    'access' => 'RT',
                    'complete' => false
                ]);
                break;
                // jika parentnya sama (done)
            case $findFrom->parent_id == $findTo->parent_id:
                $data->push([
                    'id' => $findFrom->id,
                    'name' => $findFrom->name,
                    'step' => 1,
                    'status' => 'sender',
                    'prefix' => false,
                    'access' => 'R',
                    'complete' => false
                ]);
                $data->push([
                    'id' => $findFrom->parent_id,
                    'name' => $findFrom->parent->name ?? "",
                    'step' => 2,
                    'status' => 'disposition',
                    'prefix' => true,
                    'access' => 'RD',
                    'complete' => false
                ]);
                $data->push([
                    'id' => $findTo->id,
                    'name' => $findTo->name,
                    'step' => 3,
                    'status' => 'receiver',
                    'prefix' => false,
                    'access' => 'RT',
                    'complete' => false
                ]);
                break;
                // jika parentnya tidak sama dan prefixnya sama dengan yang mau dikirim
            case $findFrom->parent_id != $findTo->parent_id && $findFrom->prefix == $findTo->prefix:
                $findParentFrom = JobPosition::where('id', $findFrom->parent_id)->first();
                $findParentTo = JobPosition::where('id', $findTo->parent_id)->first();
                $data->push([
                    'id' => $findParentFrom->id,
                    'name' => $findParentFrom->name,
                    'step' => 3,
                    'status' => 'sender',
                    'prefix' => true
                ]);
                $data->push([
                    'id' => $findParentTo->id,
                    'name' => $findParentTo->name,
                    'step' => 3,
                    'status' => 'receiver',
                    'prefix' => $type == 'melalui' ? false : true
                ]);
                while (true) {
                    if ($findParentFrom->id == $findParentTo->id) {
                        break;
                    } else {
                        $findParentFrom = JobPosition::where('id', $findParentFrom->parent_id)->first();
                        $findParentTo = JobPosition::where('id', $findParentTo->parent_id)->first();
                        if ($findParentFrom->id == $findParentTo->id) {
                            $data->push([
                                'id' => $findParentFrom->id,
                                'name' => $findParentFrom->name,
                                'step' => 3,
                                'status' => 'sender',
                                'prefix' => true
                            ]);
                        } else {
                            $data->push([
                                'id' => $findParentFrom->id,
                                'name' => $findParentFrom->name,
                                'step' => 3,
                                'status' => 'sender',
                                'prefix' => $type == 'melalui' ? false : true
                            ]);
                            $data->push([
                                'id' => $findParentTo->id,
                                'name' => $findParentTo->name,
                                'step' => 3,
                                'status' => 'receiver',
                                'prefix' => $type == 'melalui' ? false : true
                            ]);
                        }
                    }
                }
                break;
                // jika parentnya tidak sama dan prefixnya tidak sama dengan yang mau dikirim (done)
            case $findFrom->parent_id != $findTo->parent_id && $findFrom->prefix != $findTo->prefix:
                $dataFrom = LetterOutHelper::getParent($findFrom);
                $dataTo = LetterOutHelper::getParent($findTo, "receiver");
                $merge = $dataFrom->merge($dataTo->sortByDesc('step'))->unique(('id'));
                $data = $merge;
                break;
            default:
                $data->push([]);
                break;
        }

        return $data;
    }


    public static function getParent($find, $status = "sender")
    {
        $findParentFrom = JobPosition::where('id', $find->parent_id)->first();
        $no = 1;
        $dataFrom = collect([]);
        if ($status == "sender" && ($find->id == 2 || $find->id == 15)) {
            $dataFrom->push([
                'id' => $find->id,
                'name' => $find->name,
                'step' => $no++,
                'status' => $status,
                'prefix' => false,
                'access' => 'R',
                'complete' => false
            ]);
        } else {
            if ($status == "sender") {
                $dataFrom->push([
                    'id' => $find->id,
                    'name' => $find->name,
                    'step' => $no++,
                    'status' => $status,
                    'prefix' => false,
                    'access' => 'R',
                    'complete' => false
                ]);
            } else {
                $dataFrom->push([
                    'id' => $find->id,
                    'name' => $find->name,
                    'step' => $no++,
                    'status' => $status,
                    'prefix' => false,
                    'access' => 'RT',
                    'complete' => false
                ]);
            }
        }

        if ($status == "sender" && ($findParentFrom->id == 2 || $findParentFrom->id == 15)) {
            $dataFrom->push([
                'id' => $findParentFrom->id,
                'name' => $findParentFrom->name,
                'step' => $no++,
                'status' => 'disposition',
                'prefix' => true,
                'access' => 'R',
                'complete' => false
            ]);
        } else {
            $dataFrom->push([
                'id' => $findParentFrom->id,
                'name' => $findParentFrom->name,
                'step' => $no++,
                'status' => 'disposition',
                'prefix' => true,
                'access' => 'RD',
                'complete' => false
            ]);
        }
        while (true) {
            if ($findParentFrom->id == 1) {
                break;
            } else {
                $findParentFrom = JobPosition::where('id', $findParentFrom->parent_id)->first();
                if ($findParentFrom->id != 1) {
                    if ($status == "sender" && ($findParentFrom->id == 2 || $findParentFrom->id == 15)) {
                        $dataFrom->push([
                            'id' => $findParentFrom->id,
                            'name' => $findParentFrom->name,
                            'step' => $no++,
                            'status' => 'disposition',
                            'prefix' => true,
                            'access' => 'R',
                            'complete' => false
                        ]);
                    } else {
                        $dataFrom->push([
                            'id' => $findParentFrom->id,
                            'name' => $findParentFrom->name,
                            'step' => $no++,
                            'status' => 'disposition',
                            'prefix' => true,
                            'access' => 'RD',
                            'complete' => false
                        ]);
                    }
                } else {
                    if ($status == "sender" && ($findParentFrom->id == 2 || $findParentFrom->id == 15)) {
                        $dataFrom->push([
                            'id' => $findParentFrom->id,
                            'name' => $findParentFrom->name,
                            'step' => $no++,
                            'status' => 'disposition',
                            'prefix' => true,
                            'access' => 'R',
                            'complete' => false
                        ]);
                    } else {
                        $dataFrom->push([
                            'id' => $findParentFrom->id,
                            'name' => $findParentFrom->name,
                            'step' => $no++,
                            'status' => 'disposition',
                            'prefix' => true,
                            'access' => 'RD',
                            'complete' => false
                        ]);
                    }
                    break;
                }
            }
        }

        return $dataFrom;
    }


    static function generateNumber()
    {
        $letterOut = LetterOut::count();
        $letterOut = $letterOut + 1;
        return "LT-" . date('Ymdhis') . $letterOut;
    }

    static function storeGetFlow($code, $data)
    {
        foreach ($data as $item) {
            LetterFlow::create([
                'job_position_id' => $item['id'],
                'name' => $item['name'],
                'step' => $item['step'],
                'status' => $item['status'],
                'prefix' => $item['prefix'],
                'access' => $item['access'],
                'complete' => $item['complete'],
                'code' => $code
            ]);
        }
    }

    static function getJobPostion(Request $request)
    {
        // return JobPosition::with('parent')->where('name', 'not like', '%sub%')->where('name', 'not like', '%fungsional%')->where('id', '!=', auth()->user()->job_position_id)->get();
        $query = JobPosition::query()->with('parent');

        if ($request->filled('type')) {
            if ($request->type == "nota-dinas") {
                $query->where("name", "Direktur");
            } else {
                $query->where('name', 'not like', '%sub%')->where('name', 'not like', '%fungsional%');
            }
        }

        return $query->get();
    }
}
