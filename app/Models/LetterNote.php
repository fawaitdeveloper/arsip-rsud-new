<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterNote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function insertNote($code, $note)
    {
        static::create([
            'code'=>$code,
            'note'=>$note
        ]);
    }
}
