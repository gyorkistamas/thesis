<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'start_time',
        'end_time',
        'place_id',
    ];
}
