<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Attendance extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'course_class_id',
        'attendance',
        'late_minutes',
        'created_at',
        'updated_at',
    ];

    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $incrementing = true;

    public $table = 'attendances';

    public function Class()
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }
}
