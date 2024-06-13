<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function bulkStore(array $data, $request)
    {
        foreach ($data as $key => $value) {
            $pyaload = [
                "job_position_id" => $value['id'],
                'job_position_name' => $value['name'],
                'receive_position_id' => $request->receive_position_id,
                'number' => $key,
                'access' => $value['access'],
                'code' => $request->code,
                'is_store' => false,
            ];
            static::create($pyaload);
        }
    }
}
