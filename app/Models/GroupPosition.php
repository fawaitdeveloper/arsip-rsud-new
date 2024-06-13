<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function userDetail(){
        return $this->hasMany(UserDetail::class);
    }
}
