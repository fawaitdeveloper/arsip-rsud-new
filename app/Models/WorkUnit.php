<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkUnit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'work_units';

    protected $with = ['mainWorkUnit'];

    protected $fillable = [
        'main_unit_id',
        'name',
        'abbreviation',
        'address',
        'isActive'
    ];

    public function mainWorkUnit(){
        return $this->belongsTo(MainWorkUnit::class,'main_unit_id');
    }

    public function userDetail(){
        return $this->hasMany(UserDetail::class);
    }

}
