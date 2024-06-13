<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $with = [
        'user',
        'workUnit',
        'position',
        'groupPosition',
        'userCategory'
    ];

    protected $fillable = [
        'user_id',
        'work_unit_id',
        'position_id',
        'group_position_id',
        'category_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function workUnit(){
        return $this->belongsTo(WorkUnit::class, 'work_unit_id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function groupPosition(){
        return $this->belongsTo(GroupPosition::class, 'group_position_id');
    }

    public function userCategory(){
        return $this->belongsTo(UserCategory::class, 'category_id');
    }
}
