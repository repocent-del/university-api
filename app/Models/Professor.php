<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'degree',
        'join_at',
        'email',
        'address',
        'phone'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
