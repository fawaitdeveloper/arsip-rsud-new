<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainWorkUnit extends Model
{
    use HasFactory;

    protected $table = 'main_work_units';

    protected $fillable = [
        'name'
    ];

    public function workUnit(){
        return $this->hasMany(WorkUnit::class);
    }
}
