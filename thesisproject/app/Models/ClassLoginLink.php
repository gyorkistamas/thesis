<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLoginLink extends Model
{
    use HasFactory;

    public $fillable = [
        'course_class_id',
        'key',
        'invalidated',
    ];

    public function Class()
    {
        return $this->belongsTo(CourseClass::class);
    }
}
