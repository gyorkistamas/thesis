<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Attendance extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_class_id',
        'presence',
        'late_minutes',
    ];

    public $incrementing = true;
}
