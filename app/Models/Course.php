<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
        'title',
        'description',
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }
}
