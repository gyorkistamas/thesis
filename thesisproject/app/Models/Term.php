<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start',
        'end',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    public function active(): bool
    {
        if (\Date::now() >= $this->start && \Date::now() <= $this->end) {
            return true;
        }

        return false;
    }

    public function CoursesBySubjectId($subject_id): HasMany
    {
        return $this->hasMany(Course::class)
            ->where('subject_id', '=', $subject_id);
    }

    public function Courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
