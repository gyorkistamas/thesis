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

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function Place()
    {
        return $this->hasOne(Place::class);
    }

    public function StudentsWithPresence()
    {
        return $this->belongsToMany(User::class, 'presences')
            ->as('attendance')
            ->withPivot('attendance', 'late_minutes');
    }

    public function GetStudent($student_id)
    {
        return $this->belongsToMany(User::class, 'presences')
            ->as('attendance')
            ->withPivot('attendance', 'late_minutes')
            ->where('id', '=', $student_id);
    }

}