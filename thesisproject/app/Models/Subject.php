<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'credit',
        'manager',
    ];

    public function Manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager', 'id');
    }

    public function Courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function CoursesInTerm($term_id): HasMany
    {
        return $this->hasMany(Course::class)
            ->where('term_id', '=', $term_id);
    }

    public function CoursesInTermAndTeacher($term_id, $teacher_id): HasMany
    {
        if ($teacher_id == $this->Manager->id) {
            return $this->hasMany(Course::class)
                ->where('term_id', '=', $term_id);
        }

        return $this->hasMany(Course::class)
            ->where('term_id', '=', $term_id)
            ->whereHas('Teachers', function ($query) use ($teacher_id) {
                return $query->where('users.id', '=', $teacher_id);
            });
    }

    public function CoursesInTermAndStudent($term_id, $student_id): HasMany
    {
        return $this->hasMany(Course::class)
            ->where('term_id', '=', $term_id)
            ->whereHas('Students', function ($query) use ($student_id) {
                return $query->where('users.id', '=', $student_id);
            });
    }

    public function CoursesTaughtByTeacher($teacher_id): HasMany
    {
        if ($teacher_id == $this->Manager->id) {
            return $this->Courses();
        }

        return $this->hasMany(Course::class)
            ->whereHas('Teachers', function ($query) use ($teacher_id) {
                return $query->where('users.id', '=', $teacher_id);
            });
    }

    public function CoursesHasStudent($student_id): HasMany
    {
        return $this->hasMany(Course::class)
            ->whereHas('Students', function ($query) use ($student_id) {
                $query->where('users.id', '=', $student_id);
            });
    }

    public function CoursesWithClassesBetweenDatesAndStudents($student_id, $start, $end): HasMany
    {
        return $this->hasMany(Course::class)
            ->whereHas('Students', function ($query) use ($student_id) {
                $query->where('users.id', '=', $student_id);
            })
            ->whereHas('Classes', function ($query) use ($start, $end) {
                $query->where('start_time', '>=', $start);
                $query->where('end_time', '<=', $end);
            });
    }

    public function CoursesWithClassesBetweenDatesAndStudentsAndTeachers($student_id, $start, $end, $teacher_id): HasMany
    {
        return $this->hasMany(Course::class)
            ->whereHas('Students', function ($query) use ($student_id) {
                $query->where('users.id', '=', $student_id);
            })
            ->whereHas('Teachers', function ($query) use ($teacher_id) {
                $query->where('users.id', '=', $teacher_id);
            })
            ->whereHas('Classes', function ($query) use ($start, $end) {
                $query->where('start_time', '>=', $start);
                $query->where('end_time', '<=', $end);
            });
    }
}
