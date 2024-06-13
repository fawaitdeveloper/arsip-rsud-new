<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosition extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];


    public function parent()
    {
        return $this->belongsTo(JobPosition::class, 'parent_id');
    }
}
