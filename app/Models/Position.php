<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_unit_id',
        'main_position_id',
        'name',
        'isActive'
    ];

    public function workUnit(){
        return $this->belongsTo(WorkUnit::class,'work_unit_id');
    }

    public function mainPosition(){
        return $this->belongsTo(mainPosition::class,'main_position_id');
    }

    public function userDetail(){
        return $this->hasMany(UserDetail::class);
    }
}
