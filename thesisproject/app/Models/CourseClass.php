<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function isOnGoing()
    {
        return Carbon::now()->between($this->start_time, $this->end_time);
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function Loginlinks()
    {
        return $this->hasMany(ClassLoginLink::class);
    }

    public function Place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }

    public function StudentsWithPresence()
    {
        return $this->belongsToMany(User::class, 'attendances')
            ->using(Attendance::class)
            ->withPivot('attendance', 'late_minutes', 'id');
    }

    public function GetStudent($student_id)
    {
        return $this->belongsToMany(User::class, 'attendances')
            ->using(Attendance::class)
            ->withPivot('attendance', 'late_minutes', 'id')
            ->where('users.id', '=', $student_id);
    }
}
