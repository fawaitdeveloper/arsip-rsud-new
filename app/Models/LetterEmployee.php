<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterEmployee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function bulkCreate(array $data)
    {
        foreach ($data as $item) {
            static::create($item);
        }
    }
}
