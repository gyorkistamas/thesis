<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Attendance extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_class_id',
        'attendance',
        'late_minutes',
    ];

    public $incrementing = true;

    public $table = 'attendances';

    public function Class()
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }
}
