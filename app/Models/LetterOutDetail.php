<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterOutDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function position()
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
