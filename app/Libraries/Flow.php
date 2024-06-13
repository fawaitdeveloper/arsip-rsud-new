<?php

namespace App\Libraries;

use App\Models\JobPosition;

class Flow
{
    public static function get($start, $end, $removeIndex = null)
    {
        $first = JobPosition::where("id", $start)->first();
        $last = JobPosition::where("id", $end)->first();
        $newData = [];
        $number = 1;
        $newData[] = [
            ...$last->toArray(),
            'access' => 'TT',
        ];

        while (true) {
            $last = JobPosition::where("id", $last->parent_id)->first();
            if ($last) {
                if ($last->id == $first->id) {
                    $newData[] = [
                        ...$last->toArray(),
                        'access' => 'T',
                        'number' => $number++
                    ];
                    break;
                } else {
                    $newData[] = [
                        ...$last->toArray(),
                        'access' => 'T',
                    ];
                }
            }
        }
        $data = collect($newData)->sortBy('priority')->values()->all();
        if (\is_numeric($removeIndex)) {
            unset($data[$removeIndex]);
        }
        return $data;
    }
}
