<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;

    protected $table = 'user_categories';

    protected $fillable = [
        'name'
    ];

    public function userDetail(){
        return $this->hasMany(UserDetail::class);
    }
}
