<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function position(){
        return $this->hasMany(Position::class);
    }
    
}
